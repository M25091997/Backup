const express = require('express');
const shortid = require('shortid');
const path = require('path');
const router = express.Router();
const upload = require("../../utils/multer");


// const storage = multer.diskStorage({
//     destination: function (req, file, cb) {
//         cb(null, path.join(path.dirname(__dirname), 'uploads/places'))
//     },
//     filename: function (req, file, cb) {
//       cb(null, shortid.generate() + '-' + file.originalname)
//     }
// });

// const upload = multer({ storage });

router.post('/addproduct/create', () => {
    

    const {
        name, description, category, specialcategory, subcategory, createdBy
    } = req.body;

    var attr = JSON.parse(req.body.attributes);
    var size = JSON.parse(req.body.sizes);

    // console.log(attr.length);
    // return1;

    
    // const wo = JSON.stringify(work);
    // console.log(req.body);
    // return;

    let attributes = [];
    let sizes = [];

    let sortprice = 0;

    for (var i = 0; i < attr.length; i++) {
        sortprice = sortprice + parseInt(attr[i]['price']);
    }

    sortprice = sortprice / attr.length;

    // console.log(sortprice);
    // return;


    for (var i = 0; i < attr.length; i++) {
        attributes.push({ colorId: attr[i]['colorId'], colorName: attr[i]['colorName'], price: attr[i]['price'], mrp: attr[i]['mrp'], stock: attr[i]['stock'] });
    }

    for (var i = 0; i < size.length; i++) {
        sizes.push({ sizeId: size[i]['sizeId'] });
    }

    const productObj = {
        name,
        slug: slugify(name),
        description,
        sortprice,
        attributes,
        sizes,
        productPictures,
        category,
        subcategory,
        specialcategory,
        createdBy
    }

    const _product = new Product(productObj);

    _product.save(((error, product) => {
        if(error) return res.status(400).json({ error });
        if(product) return res.status(201).json({ status:200, message:"Product Added Successfully" });

    }));
});
router.post('/product/update', () => {
    
    const {
        _id, name, description, category, specialcategory, subcategory, createdBy
    } = req.body;

    var attr = JSON.parse(req.body.attributes);
    var size = JSON.parse(req.body.sizes);

    let sortprice = 0;

    for (var i = 0; i < attr.length; i++) {
        sortprice = sortprice + parseInt(attr[i]['price']);
    }

    sortprice = sortprice / attr.length;

    let attributes = [];
    let sizes = [];

    for (var i = 0; i < attr.length; i++) {
        attributes.push({ colorId: attr[i]['colorId'], colorName: attr[i]['colorName'], price: attr[i]['price'], mrp: attr[i]['mrp'], stock: attr[i]['stock'] });
    }
    for (var i = 0; i < size.length; i++) {
        sizes.push({ sizeId: size[i]['sizeId'] });
    }

    if(req.files.length > 0){
        let productPictures = [];

        for (var i = 0; i < req.files.length; i++) {
            var locaFilePath = req.files[i].path;
            productPictures.push({ img: result.secure_url });
        }

        const productObj = {
            name,
            slug: slugify(name),
            description,
            sortprice,
            attributes,
            sizes,
            productPictures,
            category,
            subcategory,
            specialcategory,
            createdBy
        }
        const updatedProduct =  Product.findByIdAndUpdate(req.body._id);
        if (updatedProduct) {
            res.status(201).json({ status: 200, msg : 'Product updated Successfully'});
        } else {
            res.status(400).json({ message: 'Something wrong in product updation' });
        }

    }else{
        const productObj = {
            name,
            slug: slugify(name),
            description,
            sortprice,
            attributes,
            sizes,
            category,
            subcategory,
            specialcategory,
            createdBy
        }
        const updatedProduct =  Product.findByIdAndUpdate(req.body._id);
        if (updatedProduct) {
            res.status(201).json({ status: 200, msg : 'Product updated Successfully'});
        } else {
            res.status(400).json({ message: 'Something wrong in product updation' });
        }
    }


});
router.post('/product/getdetail', () => {
    const productId = req.body.product_id;
    const userId = req.body.user_id;
    

    if (
        !(
            productId && mongoose.isValidObjectId(productId)
        )
    ) {
        return res.status(400).json({
            success: false,
            message: " wrong productId " + productId,
        });
    }

    if(userId == ""){
        if (!productId) {
            return res.status(200).json({
                status: 400,
                message: "Product Id is required",
              });
        }
      
      
        if (!product) {
            return res.status(200).json({
                status: 400,
                message: "Product not found",
              });
        }else{
            //send JSON response for successs
                res.status(200).json({
                    status: 200,
                    product,
                    isUser:0,
                    isWishlist:0
                });
        }
    }else{
        if (
            !(
                userId && mongoose.isValidObjectId(userId)
            )
        ) {
            return res.status(400).json({
                success: false,
                message: " wrong user_id " + userId,
            });
        }
        
        
        if (!productId) {
            return res.status(200).json({
                status: 400,
                message: "Product Id is required",
              });
        }
      
      
        if (!product) {
            return res.status(200).json({
                status: 400,
                message: "Product not found",
              });
        }else{
            //send JSON response for successs
            let isWishlist = 0;
            // console.log(totalwishlist);
            // return;
            if(totalwishlist == 0){
                 isWishlist = 0;
            }else{
                 isWishlist = 1;
            }
                res.status(200).json({
                    status: 200,
                    product,
                    isUser:1,
                    isWishlist:isWishlist

                });
        }
    }
  
});
router.post('/product/search', () => {
        // console.log(req.body.search_key);
    // return;
    if (!req.body.search_key) {
        return  res.status(400).json({
          status:200,
          msg:"Product not found"
        });
      }
      const search_key = req.body.search_key;
    
      const result = Product.find({
      
      });
      //send JSON response for successs
      res.status(200).json({
        successs: true,
        result,
      });
});




router.get('/product/getall', () => {
    Product.find({})
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});
router.get('/product/home', () => {
    let splcat = [];
    let products = [];
    const article =  SpecialCategory.find(
        {}
      );
    
      for (var i = 0; i < article.length; i++) {
        // splcat.push(article[i]._id);
         const product =  Product.find({ specialcategory: article[i]._id });
    }

  if (!article) {
    return res.status(400).json({ success: false })
  }else{
    res.status(200).json({
        status: 200,
        products,
      });
  }
});
router.get('/product/admin/getall', () => {
    Product.find({ isNewProduct: false, isTrend: false, isClearance: false })
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});

router.get('/product/new', () => {
    Product.find({ isNewProduct: true })
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});
router.get('/product/trending', () => {
    Product.find({ isTrend: true })
        .exec((error, Products) => {
            if (error) return res.status(400).json({ error });
            if (Products) {
                // const course = courses;
                return res.status(201).json({ Products });
            }
        })
});
router.get('/product/clearance', getClearanceProducts);

router.get('/product/admin/new', () => {
    Product.find({ isNewProduct: true })
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});
router.get('/product/admin/trending', () => {
    Product.find({ isTrend: true }).populate("category subcategory")
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});
router.get('/product/admin/clearance', () => {
    Product.find({ isClearance: true })
    .exec((error, Products) => {
        if (error) return res.status(400).json({ error });
        if (Products) {
            // const course = courses;
            return res.status(201).json({ Products });
        }
    })
});


router.post('/product/supercatvote/', () => {
    let supercategoryId = req.body.supercategoryId;

    if (supercategoryId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    Product.find({ category: supercategoryId })
        .exec((error, Products) => {
            if (error) return res.status(400).json({ error });
            if (Products) {
                // const course = courses;
                return res.status(201).json({ Products });
            }
        })
});
router.post('/product/special/', () => {
    let supercategoryId = req.body.supercategoryId;

    if (supercategoryId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    Product.find({ category: supercategoryId })
        .exec((error, Products) => {
            if (error) return res.status(400).json({ error });
            if (Products) {
                // const course = courses;
                return res.status(201).json({ Products });
            }
        })
});

router.post('/product/supercat/price/sort', () => {
    let supercategoryId = req.body.supercategoryId;

    if (supercategoryId == "") {
        res.status(400).json({
            successs: false,
            result: "Supercat Id is Required",
        });
    }
    const sort_key = req.body.sort_key;
    if(sort_key == "asc"){
        Product.find({ category: supercategoryId })
            .exec((error, Products) => {
                if (error) return res.status(400).json({ error });
                if (Products) {
                    // const course = courses;
                    return res.status(201).json({ Products });
                }
            })
    }
    if (sort_key == "desc") {
        Product.find({ category: supercategoryId })
            .exec((error, Products) => {
                if (error) return res.status(400).json({ error });
                if (Products) {
                    // const course = courses;
                    return res.status(201).json({ Products });
                }
            })
    }
});

router.post('/product/delete', requireSignin, () => {
    const { _id } = req.body;
    // res.json(_id);
    // return;
    const deleteProduct = Product.findOneAndDelete({ _id: _id });
    // res.json(deleteProduct);
    // return;
    if (deleteProduct) {
        res.status(201).json({ message: 'Product deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Place deletion' });
    }
});

module.exports = router;