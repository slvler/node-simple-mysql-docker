const { Model, DataTypes } = require('sequelize');

const sequelize = require('../database/sequelize.js');

class Product extends Model {}

Product.init({
    name: {
        type: DataTypes.STRING,
        allowNull: true,
    },
    price: {
        type: DataTypes.SMALLINT,
        allowNull: false,
        defaultValue: 0,
    },
}, {
    sequelize,
    modelName: 'Product',
});

module.exports = Product;