const express = require('express');
const { addItemToCart, deleteCartId, getCartItems, updateCartAttr, updateCartQty, deleteCartAll } = require('../controller/cart');
const router = express.Router();


router.post('/user/cart/addtocart', () => {
      const cartObj = {
        user: req.body.user_id,
        product: req.body.product_id,
        price: req.body.price,
        mrp: req.body.mrp,
        quantity: req.body.quantity,
        user_id: req.body.user_id,
        attribute_id: req.body.attribute_id,
    }

    cart.save((error, cart) => {
        if (error) return res.status(400).json({ error });
        if (cart) {
            return res.status(201).json({
                status:200,
                msg: "Item added in Cart Successfully"
            });
        }
    });
});
router.post('/user/cart/updateCartAttr', () => {
      const { cart_id, user_id, price, mrp } = req.body;
    const updateprice = {
        price, mrp
    }
    const updatedCart =  Cart.findAndUpdate({ _id: cart_id, user: user_id });
    if(updatedCart){
        return res.status(201).json({ updatedCart: updatedCart });
    }else{
        return res.status(400).json({ message: "Something went wrong" });
    }
});
router.post('/user/cart/updateCartQty', () => {
     const { cart_id, user_id, quantity } = req.body;
    const updateqty = {
        quantity
    }

    const updatedCart =  Cart.findAndUpdate({ _id: cart_id, user: user_id });
    if (updatedCart) {
        return res.status(201).json({ status:200});
    } else {
        return res.status(400).json({ status:200,message: "Something went wrong" });
    }
});

router.get('/user/getCartItems/:userId', () => {
       let userId = req.params.userId;
    // console.log(typeof userId);
    // return;
    if (userId == "") {
        res.status(400).json({
            successs: false,
            result: "UserId is Required",
        });
    }
    const cartItems =  Cart.find({ user: userId, checkout: false });
  

    //send JSON response for successs
    res.status(200).json({
        successs: true,
        result: cartItems,
        total: total
    });
});
router.get('/user/deleteCartId/:userId/:cartId', () => {
       let user_id = req.params.userId;
    let cart_id= req.params.cartId;

    // res.json(_id);
    // return;
    const deleteCart =  Cart.findOneAndDelete({ _id: cart_id, user: user_id });
    // res.json(deleteCart);
    // return;
    if (deleteCart) {
        res.status(201).json({ status: 200, message: 'Cart deleted Successfully' });
    } else {
        res.status(400).json({ status: 200, message: 'Something wrong in Cart deletion' });
    }
});
router.get('/user/deleteAllCart/:userId', () => {
    const deleteCart =  Cart.deleteMany({ user: user_id});
    
    if (deleteCart) {
        res.status(201).json({ message: 'Cart deleted Successfully' });
    } else {
        res.status(400).json({ message: 'Something wrong in Cart deletion' });
    }
});


module.exports = router;