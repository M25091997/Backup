const express = require('express');
const env = require('dotenv');
const app = express();
const mongoose = require('mongoose');
const path = require('path');
const cors = require('cors');
// let bodyParser = require('body-parser');

//routes
const authRoutes = require('./routes/auth');
const categoryRoutes = require('./routes/category');
const sliderRoutes = require('./routes/slider');
const cartRoutes = require('./routes/cart');
const addressRoutes = require('./routes/address');
const specialcategoryRoutes = require('./routes/specialcategory');
const notificationRoutes = require('./routes/notification');
const clearancezoneRoutes = require('./routes/clearancezone');
const clearancezonecategoryimageRoutes = require('./routes/clearancezonecategoryimage');
const firebasenotificationRoutes = require('./routes/firebasenotification');

const commercialvideoRoutes = require('./routes/commercialvideo');

const testimonialRoutes = require('./routes/testimonial');
const addproductRoutes = require('./routes/addproduct');

const statusRoutes = require('./routes/status');
const bookingRoutes = require('./routes/booking');

//environment variable or you can say constants
env.config();

//mongodb connection
//mongodb+srv://root:<password>@cluster0.pwh8q.mongodb.net/myFirstDatabase?retryWrites=true&w=majority

mongoose.connect(
    `mongodb+srv://${process.env.MONGO_DB_USER}:${process.env.MONGO_DB_PASSWORD}@cluster0.pwh8q.mongodb.net/${process.env.MONGO_DB_DATABASE}?retryWrites=true&w=majority`,
    {
        useNewUrlParser: true,
        useUnifiedTopology: true,
        // useCreateIndex: true,
        // useFindAndModify: false
    }
).then(() => {
    console.log('Database connected');
});

app.options('*', cors());
app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header('Access-Control-Allow-Methods', 'DELETE, PUT, GET, POST');
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});



app.get("/", (req, res) => {
    res.send("<h1>home</h1>");
  });

app.listen(process.env.PORT, () => {
    console.log(`Server is running on port ${process.env.PORT}`)
});