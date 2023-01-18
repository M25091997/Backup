import Link from "next/link";
import { useState, useEffect } from "react";
import { useDispatch, useSelector } from 'react-redux';
import axios from "axios";
import { Modal } from "react-bootstrap";
import Button from "react-bootstrap/Button";
import {
  GrFormPreviousLink,
  GrFormNextLink,
  GrFormFilter,
} from "react-icons/gr";
import { BsFilterLeft } from "react-icons/bs";
import { AiFillGift } from "react-icons/ai";
// import Topcategory from "./sections/Topcategory";
import Topsectiondata from "./sections/Topsectiondata";
// import Bundleproduct from "./sections/Bundleproduct";
import { useRouter } from 'next/router'
import Router from 'next/router';
import { getSearchAllProductData } from "../../redux/actions/searchproduct.actions";



const SearchProduct = () => {
  const dispatch = useDispatch();
  const searchProductData = useSelector(state => state.searchProductData);

  // const router = useRouter();
  // const { cat } = router.query;
  // console.log(cat, 'nik');

  // const [products, setProducts] = useState([]);

  const getBundleProducts = async () => {
    try {
      dispatch(getSearchAllProductData());
    } catch (e) {
      console.log(e);
    }
    // try {
    //   const response = await axios({
    //     method: "POST",
    //     url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/product-search-all-web-bo.php"
    //   });
    //   // console.log(response.data, "sanvi");
    //   setProducts(response.data.product);
    // } catch (err) {
    //   console.log(err);
    // }
  };

  useEffect(() => {
      getBundleProducts();
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

  const changeAttrPrice = (price, mrp, product_id, attr_id) => {
    let updatedPro = products.map((pro) => {
      if (pro.id === product_id) {
        return { ...pro, item_price: price, item_mrp: mrp, selected_attr_id: attr_id };
      }
      return pro;
    })
    // console.log(attr_id, 'bulu');
    // return;
    setProducts(updatedPro);
  }

  const addToCart = async (pro_id, attr_id, user_id, qty) => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme == null || useId == null ){
      Router.push('../login');
      return;
    }


    const send_data = {
      "product_id" : pro_id,
      "attr_id" : attr_id,
      "user_id" : user_id,
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
        alert('Product Added to Cart successfully');
      }
    } catch (err) {
      console.log(err);
    } 
  }

  

  return (
    <div>
      <div className="container">
        <div className="bundle_sub_section bundle_create_section ">
          <div className="container-fluid plr_40 ">
            <div className="row">
              <div className="col-lg-12">
                <div className="check_out_heading">
                  <div className="bundle_wrap">
                    <div className="bundle_heading">
                      <h1>Search Product</h1>
                    </div>
                    <p>
                      Search your favaroute products from here.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          <div className="container-fluid">
            <div className="bundle_cart mt-3">
            <div className="row">
              {searchProductData.products && searchProductData.products.length > 0 ? searchProductData.products.map((product) => (
                <div key={product.id} className="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4 mb-sm-4 mb-md-0 mb-lg-0 mt-3">
                  <div className="bundle_cart_details d-flex">
                    <div className="bundle_cart_img">
                      <img src={product.image}
                        alt=""
                        style={{ height: '150px', width: '120px', marginLeft: '20px' }} />
                    </div>
                    <div className="bundle_cart_price_quantity">
                      <h3>{product.title}</h3>
                      <h6>{product.desc}</h6>
                      <div className="bundle_cart_prices d-flex">
                        <div className="bundle_price_one ">
                          <h6>₹ {product.item_price}</h6>
                        </div>
                        <div className="bundle_price_two ms-3">
                          <h6>₹ {product.item_mrp}</h6>
                        </div>
                        <div className="bundle_price_discount ms-3">
                          <h6>10% off</h6>
                        </div>
                      </div>
                      <div className="bundle_price_gm">
                        {
                          product.attribute && product.attribute.length > 0 ? product.attribute.map((atr) => {
                            return (
                              <span onClick={() => changeAttrPrice(atr.price, atr.mrp, atr.product_id, atr.id)} style={{ cursor: 'pointer', marginRight: '10px' }} key={atr.id} className="ml_price">{atr.name}</span>
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
                        <button className="add_box" onClick={() => addToCart(product.id, product.selected_attr_id, 2, product.qty)}>Add to box</button>
                      </div>
                    </div>
                  </div>
                </div>
              )) : ""}
            </div>
            </div>
                        
          </div>
        </div>
      </div>
    </div>
  );
};

export default SearchProduct;
