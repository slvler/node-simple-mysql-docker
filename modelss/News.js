const { Model, DataTypes } = require('sequelize');

const sequelize = require('../database/sequelize.js');

class News extends Model {}

News.init({
    name: {
        type: DataTypes.STRING,
        allowNull: false,
        validate: {
            notEmpty: true
        }
    },
    content: {
        type: DataTypes.TEXT,
        allowNull: false,
        validate: {
            notEmpty: true
        }
    },
    status: {
        type: DataTypes.ENUM('ACTIVE', 'PASSIVE'),
        allowNull: false,
        defaultValue: 'ACTIVE'
    },
    slug: {
        type: DataTypes.STRING,
        allowNull: false,
        unique: true,
        validate: {
            notEmpty: true
        }
    },
    picture: {
        type: DataTypes.STRING,
        allowNull: false,
        validate: {
            notEmpty: true,
            isUrl: true
        }
    }
}, {
    sequelize,
    modelName: 'News',
    tableName: 'news',
    timestamps: true
});

module.exports = News;
