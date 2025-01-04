'use strict';
const {
  Model
} = require('sequelize');
const {models} = require("mongoose");
module.exports = (sequelize, DataTypes) => {
  class SubProduct extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // SubProduct.belongsTo(models.product, {
      //   foreignKey: 'productId',
      //   as: 'product',
      // });
      SubProduct.belongsTo(models.Product, { foreignKey: "productId" })
    }
  }
  SubProduct.init({
    productId: {
      type: DataTypes.INTEGER,
      references: {
        model: models.product,
        key: 'id',
      },
      onUpdate: 'CASCADE',
      onDelete: 'SET NULL',
    },
    name: DataTypes.STRING,
    price: DataTypes.INTEGER,
    status: DataTypes.ENUM('ACTIVE', 'PASSIVE'),

  }, {
    sequelize,
    modelName: 'SubProduct',
  });
  return SubProduct;
};



