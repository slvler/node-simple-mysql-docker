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
const category = require("./routes/category.js");
const blog = require("./routes/blog.js");
const product = require("./routes/product.js");

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
app.use("/api/v1/category", category);
app.use("/api/v1/blog", blog);
app.use("/api/v1/product", product);




app.listen(PORT, () => {
  console.log(`Server listen at port ${PORT}`);
});
