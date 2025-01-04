'use strict';
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class SubProduct extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
    }
  }
  SubProduct.init({
    name: DataTypes.STRING,
    price: DataTypes.INTEGER,
    status: DataTypes.ENUM('ACTIVE', 'PASSIVE')
  }, {
    sequelize,
    modelName: 'SubProduct',
  });
  return SubProduct;
};