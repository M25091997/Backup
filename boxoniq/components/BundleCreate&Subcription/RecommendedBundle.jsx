import Link from "next/link";
import { useState, useEffect } from "react";
import axios from "axios";

import { BsCheckLg } from "react-icons/bs";

import Topsectiondata from "./sections/Topsectiondata";
import Router from 'next/router';
import TopSectionShim from "./sections/TopSectionShim";
import ProductCardShim from "./sections/ProductCardShim";


const RecommendedBundle = () => {

  const [products, setProducts] = useState([]);
  const [bundle, setBundle] = useState({});
  
  const [loader, setLoader] = useState();

  const [cartData, setCartData] = useState([]);

  const goToProductDetail = (slug) => {
    Router.push('/item/'+slug);
  }

  const getBundleProducts = async () => {
  
    try {
      const response = await axios({
        method: "GET",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/admin-bundle-item-web-bo.php"
      });
      console.log(response.data, "sanvi");
      setBundle(response.data);
      setProducts(response.data.product);
    } catch (err) {
      console.log(err);
    }
  };

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
      console.log(response, 'hulu');
      setCartData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
      getBundleProducts();
      getCartItems();
  }, []);


  const handleDecrement = (proid, qty) => {
    if(qty==1){
      alert("quantity cant be less than 1");
      return;
    }
    let updatedPro = products.map((pro) => {
      if (pro.id === proid) {
        return { ...pro, qty: pro.qty - 1 };
      }
      return pro;
    })
    // console.log(updatedPro);
    // return;
    setProducts(updatedPro);
    // return {...products, updatedPro};
    // console.log(products);
    // return;
  };

  const handleIncrement = (proid, qty) => {
    let updatedPro = products.map((pro) => {
      if(pro.id === proid){
        return {...pro, qty: pro.qty + 1};
      }
      return pro;
    })
    // console.log(updatedPro);
    // return;
    setProducts(updatedPro);
    // return {...products, updatedPro};
    // console.log(products);
    // return;
  };

  const changeAttrPrice = (price, mrp, product_id, discount, attr_id) => {
    let updatedPro = products.map((pro) => {
      if (pro.id === product_id) {
        return { ...pro, item_price: price, item_mrp: mrp, item_discount: discount, selected_attr_id: attr_id };
      }
      return pro;
    })
    console.log(updatedPro, 'bulu');
    // return;
    setProducts(updatedPro);
  }

  const addToCart = async (pro_id, attr_id, qty) => {
    setLoader(1);
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null ){
      Router.push('../login');
      return;
    }


    const send_data = {
      "product_id" : pro_id,
      "attr_id" : attr_id,
      "user_id": useId,
      "qty" : qty
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/add-to-cart-web-bo.php",
        data: send_data
      });
      // console.log(response.data, "lulu");
      if(response.data.response == '1'){
        // alert('Product Added to Cart successfully');
        getCartItems();
        setLoader(0);
      }
    } catch (err) {
      console.log(err);
    } 
  }

  

  return (
    <div>
      <div className="container">
        <div className="bundle_sub_section bundle_create_section ">
          <div className="container-fluid">
            {bundle && bundle.name != undefined ? 
                <div className="row">
              <div className="col-3 col-lg-2">
                  <div className="check_des_area">
                      <img src={bundle.img} alt="bundle" style={{borderRadius : '40%'}} />
                  </div>
              </div>
              <div className="col-9 col-lg-10">
                  <div className="chek_text">
                      <h4>{bundle.name}</h4>
                      <p>
                          {bundle.desc}
                      </p>
                  </div>
              </div>
          </div>
             : <TopSectionShim />}
            <div className="bundle_cart mt-3">
            <div className="row">
                {products && products.length > 0 ? products.map((product) => (
                <div style={{cursor: 'pointer'}} key={product.id} className="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4 mb-sm-4 mb-md-0 mb-lg-0 mt-3">
                  <div className="bundle_cart_details d-flex">
                      <div onClick={() => goToProductDetail(product.item_slug)} className="bundle_cart_img">
                      <img src={product.image}
                        alt=""
                        style={{ height: '150px', width: '120px', marginLeft: '20px' }} />
                    </div>
                    <div className="bundle_cart_price_quantity">
                        <h3 onClick={() => goToProductDetail(product.item_slug)}>{product.title}</h3>
                        <h6 onClick={() => goToProductDetail(product.item_slug)}>{product.desc}</h6>
                      <div className="bundle_cart_prices d-flex">
                        <div className="bundle_price_one ">
                          <h6> ₹ {product.item_price}</h6>
                        </div>
                        <div className="bundle_price_two ms-3">
                          <h6 style={{textDecoration: 'line-through'}}> ₹ {product.item_mrp}</h6>
                        </div>
                        <div className="bundle_price_discount ms-3">
                          <h6>{product.item_discount}% off</h6>
                        </div>
                      </div>
                      <div className="bundle_price_gm">
                        {
                          product.attribute && product.attribute.length > 0 ? product.attribute.map((atr) => {
                            return (
                              <span onClick={() => changeAttrPrice(atr.price, atr.mrp, atr.product_id, atr.discount, atr.id)} style={{ cursor: 'pointer', marginRight: '10px', backgroundColor: atr.id == product.selected_attr_id ? "#d6ce15" : "#e8e8de"  }} key={atr.id} className="ml_price">{atr.name}</span>
                            )
                          }) : ""
                        }
                      </div>
                      <div className="bundle_cart_buttons mt-4">
                        <button
                          onClick={() => handleDecrement(product.id, product.qty)}
                          className="minus_btn "
                        >
                          -
                        </button>
                        <span>{product.qty}</span>
                        <button onClick={() => handleIncrement(product.id, product.qty)} className="plus_btn">
                          +
                        </button>
                          <button style={{ color: cartData.includes(product.id) ? "#fff" : "#53900f", backgroundColor: cartData.includes(product.id) ? "#53900f" : "#fff" }} className="add_box" onClick={() => addToCart(product.id, product.selected_attr_id, product.qty)}>{cartData.includes(product.id) ? "Added to Box" : "Add to Box"} {cartData.includes(product.id) ? <BsCheckLg/> : ""}</button>
                      </div>
                    </div>
                  </div>
                </div>
                )) : <div className=" d-flex justify-content-between"> <ProductCardShim /> <ProductCardShim /> </div>}
            </div>
            </div>

            <div className="row mt-5">
              <div className="col-lg-12 mt-5 mt-md-0 mt-lg-0 ">
                <div className="pagination_area mt-3 mt-md-0 mt-lg-0 ">
                  <div className="pagination_button d-flex justify-content-between align-items-center ">
                    <button  className="m-0 m-lg-2">
                      
                    </button>

                    <button className="p_skip_btn m-0 m-lg-2">
                      <Link href="/bundlePreview">
                        <a className="text-decoration-none text-dark">
                          Procceed to checkout
                        </a>
                      </Link>
                    </button>
                    <button className="m-0 m-lg-2">
                      
                    </button>
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

export default RecommendedBundle;
