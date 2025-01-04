
const sequelize = require('../database/sequelize.js');
// const Product = require('../models/Product.js');
// const News = require('../models/News.js');
// const Newspaper = require("../models/newspaper.js");
// const { Newspaper } = require('../models');
const { SubProduct } = require("../models");

const index = async(req, res) => {
    // const products = await Product.findAll();
    // const news = await News.findAll();
    const subProduct = await SubProduct.findAll();

    return res.json({
        status: true,
        data: subProduct,
        message: "sub-product list successfully"
    });
}

const create  = async(req, res) => {
    //let subProduct = SubProduct.create(req.body);
    const subProduct = await SubProduct.create({
        name: req.body.name,
        price: req.body.price,
        status: req.body.status
    });
    return res.json({
        status: true,
        data: subProduct.id,
        message: "sub-product create successfully"
    });
}

const show  = async(req, res) => {
    const project = await SubProduct.findOne({ where: { id: req.params.id } });
    if (project === null) {
        return res.json({
            status: false,
            message: "no record found",
        });
    } else {
        return res.json({
            status: true,
            data: project,
            message: "sub-product show successfully"
        });
    }
}

const update = async (req, res) => {

    const subProduct = await SubProduct.findOne({ where: { id: req.params.id } });

    if (subProduct === null) {
        return res.json({
            status: false,
            message: "no record found",
        });
    } else {

        await subProduct.update({
            name: req.body.name,
            price: req.body.price,
            status: req.body.status
        });
        await subProduct.save();

        // subProduct.name = req.body.name;
        // subProduct.price = req.body.price;
        // subProduct.status = req.body.status;
        //
        // await subProduct.save();

        return res.json({
            status: true,
            data: subProduct,
            message: "sub-product show successfully"
        });
    }

}

module.exports= {
    index,
    create,
    show,
    update
}
