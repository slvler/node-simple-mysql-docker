const Database = require("../database/db");
const Redis = require("ioredis");
const {checkPassword} = require("../utils/helper");
const jwt = require("jsonwebtoken");
const {JWT_SECRET, NODE_ENV} = require("../config/config");

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

module.exports = {
    index,
    show
}