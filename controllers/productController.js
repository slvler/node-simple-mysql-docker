const sequelize = require('../database/sequelize.js');
const { Product, SubProduct} = require("../models");

const index = async(req, res) => {
    const products = await Product.findAll({
        include: SubProduct,
    });

    return res.json({
        status: true,
        data: products,
        message: "Product list successfully"
    });
}

const create = async (req, res) => {

    const product = await Product.create({
        name: req.body.name,
        content: req.body.content,
        price: req.body.price,
        status: req.body.status
    });

    return res.json({
        status: true,
        data: product.id,
        message: "Product create successfully"
    });
}

module.exports  = {
    index,
    create
}
