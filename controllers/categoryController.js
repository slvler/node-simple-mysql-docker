const Database = require("../database/db");
const Redis = require("ioredis");
const {checkPassword} = require("../utils/helper");
const jwt = require("jsonwebtoken");
const {JWT_SECRET, NODE_ENV} = require("../config/config");
const { storeValidation, updateValidation } = require("../validation/categoryValidation.js");
const slugify = require('slugify')
const EventEmitter = require('events');

const eventEmitter = new EventEmitter()


const index = async (req, res) => {
    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();

    const redisClient = new Redis({
        port: 6379,
        host: "redis_service",
    });

    try {
        const redisKey = 'category:all';
        const cachedData = await redisClient.get(redisKey);
        if (cachedData) {
            console.log("Data fetched from Redis cache");
            return res.json({
                status: true,
                data: JSON.parse(cachedData),
                message: "Category listed from cache"
            });
        }
        let sql = "SELECT * FROM categories";
        connection.query(sql, async (err, rows) => {
            if (err) throw err;

            await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);

            return res.json({
                status: true,
                data: rows,
                message: "Category listed successfully"
            });

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
const show = async (req, res) => {
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
                message: "Category show from cache"
            });
        }
        let sql = `SELECT * FROM categories WHERE id = ?`;
        connection.query(sql, id, async (err, rows) => {
            if (err) throw err;
            if (rows.length){
                await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);
                return res.json({
                    status: true,
                    data: rows,
                    message: "Category show successfully"
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

  try{
      const dbInstance = Database.getInstance();
      const connection = await dbInstance.connect();

      const { name, description } = req.body;
      let slugTxt = slugify(name);

      let insert = "INSERT INTO categories (name, description, slug, status)VALUE (?, ?, ?, ?)";

      connection.query(insert, [
          name,
          description,
          slugTxt,
          "PASSIVE"
      ], (err, rows) => {
          if (err) throw err;

          eventEmitter.on('category-cached', categoryCache);
          eventEmitter.emit('category-cached');

          res.json({
              success: true,
              message: "category create successful"
          });
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

const update = async (req, res) => {
    const { error, value } = updateValidation.validate(req.body);

    if (error) {
        return res.status(401).json({
            success: false,
            message: error.details[0].message,
        });
    }

    let id = req.params.id;
    const { name, description, status } = req.body;
    let slugTxt = slugify(name);

    let sql = "UPDATE categories SET name = ?, description = ?, slug = ?, status = ? where id = ?";

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();

    connection.query(sql, [
        name,
        description,
        slugTxt,
        status,
        id
    ], async(err, rows) => {
        if (err) throw err;

        eventEmitter.on('category-cached', categoryCache);
        eventEmitter.emit('category-cached');

        if (rows.affectedRows > 0) {
            res.json({
                success: true,
                message: "category update successful"
            });
        }else{
            res.json({
                success: true,
                message: "category update failed"
            });
        }
    })
};

const destroy = async (req, res) => {
    let id = req.params.id;
    let sql = "DELETE FROM categories where id = ?"

    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();
    connection.query(sql, id, (err, rows) => {
        if (err) throw err;

        eventEmitter.on('category-cached', categoryCache);
        eventEmitter.emit('category-cached');

        if (rows.affectedRows > 0) {
            res.json({
                success: true,
                message: "category delete successful"
            });
        }else{
            res.json({
                success: true,
                message: "category delete failed"
            });
        }
    });
};


const categoryCache = async () => {
    const redisKey = 'category:all';
    const dbInstance = Database.getInstance();
    const connection = await dbInstance.connect();
    const redisClient = new Redis({
        port: 6379,
        host: "redis_service",
    });
    let sql = "SELECT * FROM categories";
    connection.query(sql, async(err, rows) => {
        if (err) throw err;
        if (rows.length){
            await redisClient.set(redisKey, JSON.stringify(rows), 'EX', 3600);
            console.log("category cached successful");
        }else{
            console.log("category list failed successful");
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