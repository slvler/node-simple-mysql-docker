const mysql = require("mysql");

// const connection = mysql.createPool({
//   connectionLimit: 10,
//   host: "mysql",
//   user: "nodejs",
//   password: "nodejs",
//   database: "nodejs",
// });
//
// module.exports = connection;


let instance = null;
class Database {
  constructor() {
    if (!instance) {
      this.connection = null;
      instance = this;
    }
    return instance;
  }

  async connect() {
    try {
      console.log("DB Connecting...");
      this.connection = mysql.createPool({
        connectionLimit: 10,
        host: "mysql",
        user: "nodejs",
        password: "nodejs",
        database: "nodejs"
      });

      console.log("Mysql Connected")
      return this.connection;
    } catch (err) {
      console.error(err);
      process.exit(1);
    }
  }

  static getInstance() {
    if (!instance) {
      instance = new Database();
    }
    return instance;
  }

}


module.exports = Database;