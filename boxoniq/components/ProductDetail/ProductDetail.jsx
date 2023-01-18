import { useState, useEffect } from "react";
import axios from "axios";
import { useRouter } from 'next/router'
import { AiTwotoneStar, AiOutlineStar } from "react-icons/ai";
import { BsCheckLg } from "react-icons/bs";
import { Rating } from 'react-simple-star-rating';

import FloatingLabel from "react-bootstrap/FloatingLabel";
import Form from "react-bootstrap/Form";
import Router from 'next/router';


const ProductDetail = () => {
  // const [quantity, setQuantity] = useState(1);
  const [productData, setProductData] = useState({});
  const [cartData, setCartData] = useState([]);
  const [ratingData, setRatingData] = useState([]);

  const [loader, setLoader] = useState();
  const [rating, setRating] = useState(0);
  const [comment, setComment] = useState('');


  const router = useRouter();
  const { its } = router.query;
  // console.log(its, 'nik');

  const handleSetRate = (rate) => {
    setRating(rate/20);
  }

  const handleDecrement = (qt) => {
    if (qt == 1) {
      alert("quantity cant be less than 1");
      return;
    }
    let updatedPro = {
      ...productData,
      "qty": qt - 1
    }

    setProductData(updatedPro);
   
  };

  const handleIncrement = (qt) => {
    let updatedPro = {
      ...productData,
      "qty" : qt + 1
    }
   
    setProductData(updatedPro);
    
  };

  const changeAttrPrice = (price, mrp, product_id, discount, attr_id) => {
    let updatedPro = {
      "image": productData.image,
      "id": product_id,
      "qty": productData.qty,
      "selected_attr_id": attr_id,
      "item_price": price,
      "item_mrp": mrp,
      "is_stock": productData.is_stock,
      "title": productData.title,
      "desc": productData.desc,
      "attribute": productData.attribute,
      "item_discount": discount
    }
   
    setProductData(updatedPro);
  }
 

  const getProdDetail = async () => {
    const pro_data = {
      product_slug: its
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/product-detail-web-bo.php",
        data: pro_data
      });
      console.log(response, 'hulu');
      setProductData(response.data.product);
    } catch (err) {
      console.log(err);
    }
  };

  const saveRating = async(proId) => {
    const useId = localStorage.getItem('user_id');
    if (useId == null) {
      Router.push('../login');
      return;
    }
    const send_data = {
      "product_id": proId,
      "account_id": useId,
      "rating": rating,
      "comment": comment
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/save-rating-web-bo.php",
        data: send_data
      });

      if(response.data.response == '1'){
        alert(response.data.msg);
        getRating();
        setComment('');
        setRating(0);
      }

    } catch (err) {
      console.log(err);
    }
  }

  const shopNow = async (pro_id, attr_id, qty) => {
    // setLoader(1);
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }


    const send_data = {
      "product_id": pro_id,
      "attr_id": attr_id,
      "user_id": useId,
      "qty": qty
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-to-cart-web-bo.php",
        data: send_data
      });
      // console.log(response.data, "lulu");
      if (response.data.response == '1') {
        // alert('Product Added to Cart successfully');
        // getCartItems();
        // setLoader(0);
        Router.push('../bundlePreview');
      }
    } catch (err) {
      console.log(err);
    }
  }

  const addToCart = async (pro_id, attr_id, qty) => {
    setLoader(1);
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }


    const send_data = {
      "product_id": pro_id,
      "attr_id": attr_id,
      "user_id": useId,
      "qty": qty
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-to-cart-web-bo.php",
        data: send_data
      });
      // console.log(response.data, "lulu");
      if (response.data.response == '1') {
        // alert('Product Added to Cart successfully');
        getCartItems();
        setLoader(0);
      }
    } catch (err) {
      console.log(err);
    }
  }

  const getCartItems = async () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null) {
      Router.push('../login');
      return;
    }
    const send_data = {
      "user_id": useId
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/check-item-cart-web-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setCartData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  const getRating = async () => {
    const send_data = {
      product_slug: its
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-rating-list-web.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setRatingData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    if (its != undefined) {
      getProdDetail();
      getRating();
    }
    getCartItems();
  }, [its]);

  return (
    <div className="himalaya_soap_container">
      <div className="profile_section">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className=" text-center himalay_container_title ">
                <h4 className="global_himalaya_title">{productData.title}</h4>
              </div>
            </div>
          </div>
          <div className="row himalay_container">
            <div className="col-lg-10">
              <div className="row himalay_container">
                <div className="col-lg-5 mb-3">
                  <div className="himalaya_img">
                    <img src={productData.image} alt="" />
                  </div>
                  <div className="himalaua_price_quantity_container">
                    <div className="himalaya_title">
                      <h3>{productData.title}</h3>
                    </div>
                    <div className="himalaya_price_quantity">
                      <div className="himalay_quantity">
                        <h5>MRP</h5>
                        <h5>Price</h5>
                        <h5>Quantity</h5>
                      </div>
                      <div className="himalay_price">
                        <h5>₹ {productData.item_mrp}</h5>
                        <h5>₹ {productData.item_price}</h5>
                        <div className="Soap_quantity_buttons">
                          <button
                            onClick={() => handleDecrement(productData.qty)}
                            className="Soap_quantity_minus"
                          >
                            -
                          </button>{" "}
                          <span className="soap_number">{productData.qty}</span>
                          <button
                            onClick={() => handleIncrement(productData.qty)}
                            className="Soap_quantity_plus"
                          >
                            +
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="product_description">
                    <div className="product_description_title">
                      <h3>Product Attributes</h3>
                    </div>
                    <div className="bundle_price_gm">
                      {
                        productData.attribute && productData.attribute.length > 0 ? productData.attribute.map((atr) => {
                          return (
                            <span onClick={() => changeAttrPrice(atr.price, atr.mrp, atr.product_id, atr.discount, atr.id)} style={{ cursor: 'pointer', marginRight: '10px', backgroundColor: atr.id == productData.selected_attr_id ? "#d6ce15" : "#e8e8de" }} key={atr.id} className="ml_price">{atr.name}</span>
                          )
                        }) : ""
                      }
                    </div>
                    {/* <div className="product_description_buttons">
                      <button className="product_des_button">50gm</button>
                      <button className="product_des_button white_button">
                        100gm
                      </button>
                    </div> */}
                  </div>
                  <div className="shop_cart_buttons">
                    <button onClick={() => shopNow(productData.id, productData.selected_attr_id, productData.qty)} className="shop_now">Shop Now</button>
                    <button style={{ color: cartData.includes(productData.id) ? "#fff" : "#53900f", backgroundColor: cartData.includes(productData.id) ? "#53900f" : "#fff" }} onClick={() => addToCart(productData.id, productData.selected_attr_id, productData.qty)} className="add_cart">{cartData.includes(productData.id) ? "Added to Box" : "Add to Box"} {cartData.includes(productData.id) ? <BsCheckLg /> : ""}</button>
                  </div>
                </div>

                <div className="col-lg-6">
                  <div className="himalaya_product_description">
                    <h3>Product Description</h3>
                    <p>
                      It is a long established fact that a reader will be distra
                      cted by the readable content of a page when looking at its
                      layout. The point of using Lorem Ipsum is that it has a
                      more-or-less normal distribution of letters, as opposed to
                      using Content here, content here, making it look like
                      readable English. Many desktop publishing packages and web
                      page editors now use Lorem Ipsum as their default model
                      text, and a search for lorem ipsum will uncover many web
                      sites still in their infancy.
                    </p>
                  </div>
                  <div className="review_ratings">
                    {ratingData && ratingData.length > 0 ? ratingData.map((item) => {
                      return (
                        <div key={item.rating_id} className="review_rating_single_part">
                          <div className="ratings_des">
                            <h3>{item.name}</h3>
                            <h6>{item.trn_date}</h6>
                            <p>{item.comment}</p>
                          </div>
                          <div className="rating_stars">
                            <Rating
                              initialValue={item.rating} />
                          </div>
                        </div>
                      )
                    }) : ""}
                    
                    <div className="send_reviews">
                      <div className="write_reviews">
                        <h3>Write your review and rating here</h3>
                        <p>
                          It is a long established fact that a reader will be
                          distracted by the readable content of a page when
                          looking at its layout.
                        </p>
                      </div>
                      <div className="form_textarea">
                        <FloatingLabel controlId="floatingTextarea2">
                          <Form.Control
                            as="textarea"
                            className="form_input_textarea"
                            style={{ height: "100px" }}
                            value={comment}
                            onChange={(e) => setComment(e.target.value)}
                          />
                        </FloatingLabel>
                      </div>
                      <div className="horzontal_border"></div>
                      <div className="send_review_stars">
                        {/* <h5 style={{ fontSize: '60px' }}>{rating}</h5> */}
                        <Rating
                          onClick={handleSetRate}
                          ratingValue={rating} />
                      </div>
                      <div className="save_button">
                        <button onClick={() => saveRating(productData.id)}>Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProductDetail;
