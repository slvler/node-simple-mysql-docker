const express = require("express");
const {
  PORT,
  DB_CONNECTION,
  DB_HOST,
  DB_PORT,
  DB_DATABASE,
  DB_USERNAME,
  DB_PASSWORD,
} = require("./config/config.js");

// router
const auth = require("./routes/auth.js");

// const connection = mysql.createPool({
//   connectionLimit: 10,
//   host: "mysql",
//   user: "nodejs",
//   password: "nodejs",
//   database: "nodejs",
// });

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use("/api/v1/auth", auth);




app.listen(PORT, () => {
  console.log(`Server listen at port ${PORT}`);
});
