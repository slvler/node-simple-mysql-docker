const Database = require("../database/db");
const Redis = require("ioredis");
const EventEmitter = require('events');
const { storeValidation, updateValidation } = require("../validation/blogValidation.js");


const eventEmitter = new EventEmitter();

const index = async(req, res) => {

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();

    const redisClient = new Redis({
        port: 6379,
        host: "redis_service",
    });

    try{
        const redisKey = 'blogs:all';
        const cachedData = await redisClient.get(redisKey);
        if (cachedData) {
            console.log("Data fetched from Redis cache");
            return res.json({
                status: true,
                data: JSON.parse(cachedData),
                message: "blog listed from cache"
            });
        }

        let sql = "SELECT * FROM blogs INNER JOIN categories on blogs.category_id = categories.id";
        connection.query(sql, async(err, rows) => {
            if (err) throw err;
            if (rows.length){
                await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);
                return res.json({
                    status: true,
                    data: rows,
                    message: "Blog list successfully"
                });
            }else{
                return res.json({
                    status: false,
                    message: "Invalid credentials",
                });
            }
        });
    } catch (error) {
        console.error("Error connecting to Redis:", error);
        return res.status(500).json({
            status: false,
            message: "Internal Server Error",
            mes: error
        });
    }
}

const show = async(req, res) => {

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();
    const redisClient = new Redis({
        port: 6379,
        host: "redis_service",
    });
    const id = req.params.id;
    try{
        const redisKey = `category:show:${id}`;
        const cachedData = await redisClient.get(redisKey);
        if (cachedData) {
            console.log("Data fetched from Redis cache");
            return res.json({
                status: true,
                data: JSON.parse(cachedData),
                message: "Blog show from cache"
            });
        }
        let sql = `SELECT * FROM blogs WHERE id = ?`;
        connection.query(sql, id, async (err, rows) => {
            if (err) throw err;
            if (rows.length){
                await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);
                return res.json({
                    status: true,
                    data: rows,
                    message: "Blog show successfully"
                });
            }else{
                return res.json({
                    status: false,
                    message: "Invalid credentials",
                });
            }
        });
    } catch (error) {
        console.error("Error connecting to Redis:", error);
        return res.status(500).json({
            status: false,
            message: "Internal Server Error",
            mes: error
        });
    }

}

const store = async (req, res) => {

    const { error, value } = storeValidation.validate(req.body);

    if (error) {
        return res.status(401).json({
            success: false,
            message: error.details[0].message,
        });
    }
    const { title, content, category_id, status } = req.body;
    let sql = "INSERT INTO blogs (title, content, category_id, status)VALUE (?,?,?,?)"

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();

    connection.query(sql, [
        title,
        content,
        category_id,
        status
    ], (err, rows) => {

        if (err) throw err;
        if (rows.affectedRows > 0) {

            eventEmitter.on('blog-cached', blogCache);
            eventEmitter.emit('blog-cached');

            res.json({
                success: true,
                message: "blog store successful"
            });
        }else{
            res.json({
                success: true,
                message: "blog store failed"
            });
        }
    });

}

const update = async(req, res) => {

    const { error , value } = updateValidation.validate(req.body);

    if (error) {
        return res.status(401).json({
            success: false,
            message: error.details[0].message,
        });
    }

    try {
        const id = req.params.id;
        const { title, content, category_id, status } = req.body;

        let sql = "UPDATE blogs SET title=?, content=?, category_id=?, status=? where id=?"

        const dbInstance = Database.getInstance();
        const connection = await dbInstance.connect();

        connection.query(sql, [
            title,
            content,
            category_id,
            status,
            id
        ], async(err, rows) => {

            if (err) throw err;
            if (rows.affectedRows > 0) {

                eventEmitter.on('blog-cached', blogCache);
                eventEmitter.emit('blog-cached');


                res.json({
                    success: true,
                    message: "blog update successful"
                });
            }else{
                res.json({
                    success: true,
                    message: "blog update failed"
                });
            }
        })
    } catch (error) {
        console.error("Error connecting to Redis:", error);
        return res.status(500).json({
            status: false,
            message: "Internal Server Error",
            mes: error
        });
    }
}

const destroy = async (req, res) => {
    let id = req.params.id;
    let sql = "DELETE FROM blogs where id = ?"

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();
    connection.query(sql, id, (err, rows) => {
        if (err) throw err;
        if (rows.affectedRows > 0) {

            eventEmitter.on('blog-cached', blogCache);
            eventEmitter.emit('blog-cached');
            res.json({
                success: true,
                message: "blog delete successful"
            });
        }else{
            res.json({
                success: true,
                message: "blog delete failed"
            });
        }
    });
}

const blogCache = async () => {
    const redisKey = 'blogs:all';
    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();
    const redisClient = new Redis({
        port: 6379,
        host: "redis_service",
    });
    let sql = "SELECT * FROM blogs INNER JOIN categories on blogs.category_id = categories.id";
    connection.query(sql, async(err, rows) => {
        if (err) throw err;
        if (rows.length){
            await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);
            console.log("blog cached successful");
        }else{
            console.log("blog list failed successful");
        }
    });
};


module.exports = {
    index,
    show,
    store,
    update,
    destroy
}