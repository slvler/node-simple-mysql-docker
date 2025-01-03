const {
  loginValidation,
  registerValidation,
} = require("../validation/authValidation");
const Database = require("../database/db.js");
const { doHash, checkPassword } = require("../utils/helper.js");
const { SALT, JWT_SECRET, NODE_ENV } = require("../config/config1.js");
const jwt = require("jsonwebtoken");

const login = async (req, res) => {

  const { error, value } = loginValidation.validate(req.body);

  if (error) {
    return res.status(401).json({
      success: false,
      message: error.details[0].message,
    });
  }

  const dbInstance = Database.getInstance();
  const connection = await dbInstance.connect();

  const { email, password } = req.body;

  let sql = `SELECT * FROM users WHERE email = ?`;

  connection.query(sql, email, async (err, rows, fields) => {
    if (err) throw err;

    if (rows.length){

      const hashedPassword = rows[0].password;
      const isMatch = await checkPassword(password, hashedPassword);

      if (isMatch) {

        const token = jwt.sign(
            {
              _id: rows[0]._id,
              email: rows[0].email,
              name: rows[0].name,
            },
            JWT_SECRET,
            {
              expiresIn: "8h",
            },
        );

        return res
            .status(200)
            .cookie("Authorization", "Bearer " + token, {
              expires: new Date(Date.now() + 8 * 3600000),
              httpOnly: NODE_ENV === "production",
              secure: NODE_ENV === "production",
            })
            .json({
              success: true,
              token,
              message: "Login successful",
            });

      } else {
        return res.json({
          status: false,
          message: "Invalid credentials",
        });
      }
    }

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
