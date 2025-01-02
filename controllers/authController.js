const {
  loginValidation,
  registerValidation,
} = require("../validation/authValidation");
const Database = require("../database/db.js");
const { doHash } = require("../utils/helper.js");

const login = (req, res) => {
  return res.json({
    hello: "hello world",
  });
};

const register = async (req, res) => {
  const { error, value } = registerValidation.validate(req.body);

  const dbInstance = Database.getInstance();
  const connection = await dbInstance.connect();

  if (error) {
    return res.status(401).json({
      success: false,
      message: error.details[0].message,
    });
  }
  const { email, name, surname, password } = req.body;

  let sql = `SELECT * FROM users WHERE email = ?`;
   connection.query(sql, email, async (err, rows) => {
    if (err) throw err;
    if (!rows.length){

      const ps = await doHash(password);

      let insert = "INSERT INTO users (email, password, name, surname, status) VALUES(?, ?, ?, ?, ?)";
      connection.query(insert, [
        email,
        ps,
        name,
        surname,
        "PASSIVE"
      ], (err, rows) => {
        if (err) throw err;
        res.json({
          success: true,
          message: "Register successful"
        });
      });
    }else{
      res.json({
        success: false,
        message: "there is user registration with this email address. please log in",
      });
    }
  });
};

module.exports = {
  login,
  register,
};
