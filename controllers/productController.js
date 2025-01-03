
const sequelize = require('../database/sequelize.js');
const Product = require('../models/Product.js');
const News = require('../models/News.js');


const index = async(req, res) => {
    const products = await Product.findAll();
    const news = await News.findAll();

    return res.json({
        status: true,
        message: "Blog list successfully"
    });
}

module.exports = index;
