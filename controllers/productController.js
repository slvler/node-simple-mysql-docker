
const sequelize = require('../database/sequelize.js');
// const Product = require('../models/Product.js');
// const News = require('../models/News.js');
// const Newspaper = require("../models/newspaper.js");
const { Newspaper } = require('../models');


const index = async(req, res) => {
    // const products = await Product.findAll();
    // const news = await News.findAll();
    const newspaper = await Newspaper.findAll();


    return res.json({
        status: true,
        data: newspaper,
        message: "Blog list successfully"
    });
}

module.exports = index;
