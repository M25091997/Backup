const express = require("express");
require("dotenv").config();
const app = express();
const cookieParser = require("cookie-parser");
const mongoSanitize = require("express-mongo-sanitize");
const xss = require("xss-clean");
const cors = require("cors");

//regular middleware
app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(mongoSanitize());
app.use(xss());

//cookies and file middleware
app.use(cookieParser());
app.use(
  fileUpload({
    useTempFiles: true,
    tempFileDir: "/tmp/",
  })
);



//import all routes here
const user = require("./routes/user");
const article = require("./routes/article");
const ott = require("./routes/ott");
const category = require("./routes/category");
const contact = require("./routes/contact");
const imageLibrary = require("./routes/imageLibrary");



app.get("/", (req, res) => {
  res.send("<h1>home</h1>");
});

// export app js
module.exports = app;
