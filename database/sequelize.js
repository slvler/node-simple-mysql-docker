const { Sequelize } = require("sequelize");

const sequelize = new Sequelize('nodejs', 'nodejs', 'nodejs', {
    host: 'mysql',
    dialect: 'mysql'
});

async function sequelizeConnection() {
    try {
        await sequelize.authenticate();
        await sequelize.sync();
        console.log("Database connected successfully");
    } catch (error) {
        console.error("Unable to connect to the database:", error);
    }
}

sequelizeConnection();

module.exports = sequelize;