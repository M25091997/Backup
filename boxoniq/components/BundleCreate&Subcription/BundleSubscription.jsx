import Link from "next/link";
import { useState, useEffect } from "react";
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
import TopCatShim from "./sections/TopCatShim";
import TopSectionShim from "./sections/TopSectionShim";
import ProductCardShim from "./sections/ProductCardShim";


const BundleSubscription = () => {
  const router = useRouter();
  const { cat } = router.query;
  // console.log(cat, 'nik');

  const [products, setProducts] = useState([]);
  const [bundle, setBundle] = useState({});
  const [topcatData, setTopcatData] = useState([]);
  const [seqid, setSeqid] = useState(1);
  const [loader, setLoader] = useState();

  
  const [selectedbrandid, setSelectedbrandid] = useState([]);
  const [selectedsubcatid, setSelectedsubcatid] = useState([]);


  const [brandData, setBrandData] = useState([]);
  const [subcatData, setSubcatData] = useState([]);
  const [cartData, setCartData] = useState([]);


  const selectBrand = (brandId) => {
    let checkbrand = selectedbrandid.includes(parseInt(brandId));
      // const index = selectedbrandid.indexOf(brandId);
      // console.log(index, 'nun');
    // if (index > -1 || index == 0) { // only splice array when item is found
    //   selectedbrandid.splice(index, 1); // 2nd parameter means remove one item only
    // }

    if(brandId!=undefined && checkbrand != true){
      setSelectedbrandid(selectedbrandid => [...selectedbrandid, parseInt(brandId)]);
    }
    console.log(selectedbrandid, 'nun');
  }

  const selectSubcat = (subcatId) => {
    let checksubcat = selectedsubcatid.includes(parseInt(subcatId));
    // const index = selectedsubcatid.indexOf(subcatId);
    // console.log(index, 'nun');
    // if (index > -1 || index == 0) { // only splice array when item is found
    //   selectedsubcatid.splice(index, 1); // 2nd parameter means remove one item only
    // }

    if (subcatId != undefined && checksubcat != true) {
      setSelectedsubcatid(selectedsubcatid => [...selectedsubcatid, parseInt(subcatId)]);
    }
    console.log(selectedsubcatid, 'nun');
  }

  const getBrandfilter = async () => {
   const send_data = {
      "sequence": parseInt(seqid)
    };
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/get-brand-subcategory-web-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setBrandData(response.data.brand);
      setSubcatData(response.data.subcat);
    } catch (err) {
      console.log(err);
    }
  };

  const getTopCat = async () => {
    try {
      const response = await axios({
        method: "GET",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/super-cat-bo.php"
      });
      // console.log(response, 'hulu');
      setTopcatData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  const getBundleProducts = async (sequence_id) => {
    const send_data = {
      "sequence": sequence_id
    }
    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/product-super-cat-web-bo.php",
        data: send_data
      });
      // console.log(response.data, "sanvi");
      setBundle(response.data);
      setProducts(response.data.product);
    } catch (err) {
      console.log(err);
    }
  };

  const changeBundleProducts = (seq_id) => {
    Router.push('../bundleCreator');
    setSeqid(seq_id);
    getBundleProducts(seq_id);
    setSelectedbrandid([]);
    setSelectedsubcatid([]);
  }

  const changeBundleProductsNextPrev = (key) => {
    if(seqid==1 && key==-1){
      return;
    }
    const newseqid = seqid + (key);
    // console.log(newseqid, 'pulu');
    getBundleProducts(newseqid);
    setSeqid(newseqid);
  }

  const getActiveProcessId = async () => {
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
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/check-item-subs-cart-web-bo.php",
        data: send_data
      });
      console.log(response, 'hulu');
      setCartData(response.data);
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
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/check-item-subs-cart-web-bo.php",
        data: send_data
      });
      // console.log(response, 'hulu');
      setCartData(response.data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    if (cat != undefined) {
      getBundleProducts(cat);
    }else{
      getBundleProducts(seqid);
    }
    getTopCat();
    getBrandfilter();
    getCartItems();
    // }
  }, [seqid]);

  const [show, setShow] = useState(false);
  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  const [oneshow, setOne] = useState(false);
  const oneClose = () => setOne(false);
  const oneShow = () => setOne(true);

  const [twoshow, setTwo] = useState(false);
  const twoClose = () => setTwo(false);
  const twoShow = () => setTwo(true);

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
    // console.log(attr_id, 'bulu');
    // return;
    setProducts(updatedPro);
  }

  const addToCart = async (pro_id, attr_id, user_id, qty) => {
    setLoader(1);
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    const proceId = localStorage.getItem('activeProcessId');
    if (useNme == null || useId == null ){
      Router.push('../login');
      return;
    }

    if (proceId == null ){
      Router.push('../bundleCreator');
      return;
    }

    const send_data = {
      "product_id" : pro_id,
      "attr_id" : attr_id,
      "user_id" : user_id,
      "qty" : qty,
      "process_id" : proceId
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/droid/add_items_web.php",
        data: send_data
      });
      // console.log(response.data, "niks");
      if(response.data.response == '1'){
        getCartItems();
        setLoader(0);
      }
    } catch (err) {
      console.log(err);
    } 
  }

  const sortByFilter = async () => {
    setBundle({});
    setProducts([]);
    // console.log(selectedsubcatid);
    // console.log(selectedbrandid);
    // return;

    const send_data = {
      "sequence": 1,
      "sort": 0,
      "sort_key": 0,
      "filter": 1,
      "brand_key": selectedbrandid,
      "sub_key": selectedsubcatid
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/product-super-cat-web-bo-filter.php",
        data: send_data
      });
      // console.log(response.data, "lulu");
      if (response.data.response == '1') {
        setBundle(response.data);
        setProducts(response.data.product);
        setTwo(false);
        // setBundle(response.data);
        // setProducts(response.data.product);

        // alert('Sorting done successfully');
      }
    } catch (err) {
      console.log(err);
    }
  }
 
  const sortByPrice = async(sort_k) => {
    setBundle({});
    setProducts([]);
    const send_data = {
      "sequence": 1,
      "sort": 1,
      "sort_key": sort_k
    }

    try {
      const response = await axios({
        method: "POST",
        url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/product-super-cat-web-bo-filter.php",
        data: send_data
      });
      // console.log(response.data, "lulu");
      if (response.data.response == '1') {
        setBundle(response.data);
        setProducts(response.data.product);
        setOne(false);
        // setBundle(response.data);
        // setProducts(response.data.product);
        
        // alert('Sorting done successfully');
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
                      <h1>Create Your Bundle</h1>
                      <Button
                        className="add_more_btn filter_btn btn-primary my-3 my-lg-0 d-none d-md-block d-lg-block"
                        variant="primary"
                        onClick={twoShow}
                      >
                        <img
                          src="https://i.ibb.co/yqm1v4Q/filter-list.png"
                          alt=""
                        />
                        Filter
                      </Button>

                      <Modal show={oneshow} onHide={oneClose}>
                        <Modal.Header closeButton>
                          <Modal.Title>
                            <div className="modal_title">
                              <h3>Sort</h3>
                            </div>
                          </Modal.Title>
                        </Modal.Header>
                        <Modal.Body className="sort_modal_body">
                          <div className="sort_title">
                            Select the following to sort1
                          </div>

                          <div className="row mt-3">
                            <div className="col-4">
                              <div className="popularity_sort">
                                <button className="popularity_btn">
                                  Popularity
                                </button>
                              </div>
                            </div>
                            <div className="col-4">
                              <div className="popularity_sort">
                                <Button onClick={() => sortByPrice(2)}>Price high to low</Button>
                              </div>
                            </div>
                            <div className="col-4">
                              <div className="popularity_sort">
                                <Button onClick={() => sortByPrice(1)}>Price low to high</Button>
                              </div>
                            </div>
                          </div>
                        </Modal.Body>
                      </Modal>
                      <Button
                        className="add_more_btn filter_btn btn-success d-none d-md-block d-lg-block"
                        variant="primary"
                        onClick={oneShow}
                      >
                        <img
                          src="https://i.ibb.co/yqm1v4Q/filter-list.png"
                          alt=""
                        />
                        Sorting
                      </Button>

                      <Modal show={twoshow} onHide={twoClose}>
                        <Modal.Header closeButton>
                          <Modal.Title>
                            <h3>Filter</h3>
                          </Modal.Title>
                        </Modal.Header>
                        <Modal.Body className="sort_modal_body">
                          <div className="sort_title">
                            <h6>Slect any of the following to filter</h6>
                            <h3>Filter By Brand</h3>
                          </div>

                          <div
                            style={{ width: "98%" }}
                            className=" d-flex mt-3 justify-content-between"
                          >
                            {brandData && brandData.length > 0 ? brandData.map((brand) => {
                              return (
                                <div key={brandData.id} className="popularity_sort">
                                  <button className="">{brandData.brand}</button>
                                </div>
                              )
                            }) : ""}
                            

                          </div>
                          <div className="sort_title_sort">
                            <h3>Filter By Sub Category</h3>
                          </div>
                          <div className=" d-flex mt-3 justify-content-center">
                            {subcatData && subcatData.length > 0 ? subcatData.map((sub) => {
                              return (
                                <div key={sub.id} className="popularity_sort ms-4">
                                  <button>{sub.name}</button>
                                </div>
                              )
                            }) : ""}

                            
                          </div>
                          <div className="sort_button mt-4">
                            <button onClick={() => sortByFilter()}>Filter</button>
                          </div>
                        </Modal.Body>
                      </Modal>
                    </div>
                    <p>
                      Select from the list of products from different categories
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div className="finter_area d-none d-md-block d-lg-block">
            <div className="container-fluid plr_40">
              <div className="row ">
                <div className="col-12 col-lg-12">
                  <div className="button_area">
                    {topcatData && topcatData.length > 0 ? topcatData.map((item) => {
                      return (
                        <button style={{ backgroundColor: seqid == item.sequence ? "#fff" : "", color: seqid == item.sequence ? "#53900f" : "" }} onClick={() => changeBundleProducts(item.sequence)} key={item.id}>{item.name.slice(0, 13)}</button>
                      )
                    }) : 
                      <div className="d-flex justify-content-between">
                        <TopCatShim /><TopCatShim /><TopCatShim /><TopCatShim /><TopCatShim /><TopCatShim />
                    </div>
                    }
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="row d-block d-md-none d-lg-none">
            <div className="col-12">
              <div className="shortings_filter_button">
                <button className="gift">
                  <AiFillGift className="gift_svg" />
                </button>
                <button onClick={twoShow} className="filter_one">
                  <BsFilterLeft />
                </button>
                <button onClick={oneShow} className="filter_two">
                  <GrFormFilter />
                </button>
              </div>
              <Modal show={oneshow} onHide={oneClose}>
                <Modal.Header closeButton>
                  <Modal.Title>Sort</Modal.Title>
                </Modal.Header>
                <Modal.Body className="sort_modal_body">
                  <div className="sort_title">Slect the following to sort</div>

                  <div className="row mt-3">
                    <div className="col-4">
                      <div className="popularity_sort">
                        <button className="popularity_btn">Popularity</button>
                      </div>
                    </div>
                    <div className="col-4">
                      <div className="popularity_sort">
                        <Button onClick={() => sortByPrice(2)}>Price high to low</Button>
                      </div>
                    </div>
                    <div className="col-4">
                      <div className="popularity_sort">
                        <Button onClick={() => sortByPrice(1)}>Price low to high</Button>
                      </div>
                    </div>
                  </div>
                </Modal.Body>
              </Modal>
              <Modal show={twoshow} onHide={twoClose}>
                <Modal.Header closeButton>
                  <Modal.Title>
                    <h3>Filter</h3>
                  </Modal.Title>
                </Modal.Header>
                <Modal.Body className="sort_modal_body">
                  <div className="sort_title">
                    <h6>Slect any of the following to filter</h6>
                    <h3>Filter By Brand</h3>
                  </div>

                  <div
                    style={{ width: "98%" }}
                    className=" d-flex mt-3 justify-content-between"
                  >
                    {brandData && brandData.length > 0 ? brandData.slice(0,4).map((brand) => {
                      return (
                        // #eda521
                        <div key={brand.id} className="popularity_sort">
                          <button onClick={() => selectBrand(brand.id)} style={{ background: selectedbrandid == brand.id ? '#eda521' :'#efb750'}} className="">{brand.name}</button>
                        </div>
                      )
                    }) : ""}
                  </div>
                  <div
                    style={{ width: "98%" }}
                    className=" d-flex mt-3 justify-content-between"
                  >
                    {brandData && brandData.length > 0 ? brandData.slice(4, 8).map((brand) => {
                      return (
                        <div key={brand.id} className="popularity_sort">
                          <button onClick={() => selectBrand(brand.id)} style={{ background: '#efb750' }} className="">{brand.name}</button>
                        </div>
                      )
                    }) : ""}
                  </div>
                  <div className="sort_title_sort">
                    <h3>Filter By Sub Category</h3>
                  </div>
                  <div className=" d-flex mt-3 justify-content-center">
                    {subcatData && subcatData.length > 0 ? subcatData.map((sub) => {
                      return (
                        <div key={sub.id} className="popularity_sort ms-4">
                          <button onClick={() => selectSubcat(sub.id)}>{sub.name}</button>
                        </div>
                      )
                    }) : ""}
                  </div>
                  <div className="sort_button mt-4">
                    <button onClick={() => sortByFilter()}>Filter</button>
                  </div>
                </Modal.Body>
              </Modal>
            </div>
          </div>
          <div className="container-fluid">
            {bundle && bundle.name != undefined ? <Topsectiondata x={bundle} /> : <TopSectionShim />}
            <div className="bundle_cart mt-3">
            <div className="row">
                {products && products.length > 0 ? products.map((product) => (
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
                        <h6 style={{textDecoration: 'line-through'}}> ₹ {product.item_mrp}</h6>
                        </div>
                        <div className="bundle_price_discount ms-3">
                          <h6>{product.item_discount} % off</h6>
                        </div>
                      </div>
                      <div className="bundle_price_gm">
                        {
                          product.attribute && product.attribute.length > 0 ? product.attribute.map((atr) => {
                            return (
                              <span onClick={() => changeAttrPrice(atr.price, atr.mrp, atr.product_id, atr.discount, atr.id)} style={{ cursor: 'pointer', marginRight: '10px', backgroundColor: atr.id == product.selected_attr_id ? "#d6ce15" : "#e8e8de" }} key={atr.id} className="ml_price">{atr.name}</span>
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
                        <button style={{color:cartData.includes(product.id) ? "#fff" : "#53900f", backgroundColor:cartData.includes(product.id) ? "#53900f" : "#fff"}} className="add_box" onClick={() => addToCart(product.id, product.selected_attr_id, 2, product.qty)}>{cartData.includes(product.id) ? "Added to Box" : "Add to Box"}{loader?<img src="/images/loader.gif" alt="loader"/> : ""}</button>
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
                    <button onClick={() => changeBundleProductsNextPrev(-1)} className="prev_btn m-0 m-lg-2">
                      <img src="/images/Vector.png" alt="" />
                      <span> Prev</span>
                    </button>

                    <button className="p_skip_btn m-0 m-lg-2">
                      <Link href="/subscription">
                        <a className="text-decoration-none text-dark">
                          Back to subscription
                        </a>
                      </Link>
                    </button>
                    <button onClick={() => changeBundleProductsNextPrev(1)} className="next_btn m-0 m-lg-2">
                      <span>Next</span>
                      <img src="/images/Vector2.png" alt="" />
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

export default BundleSubscription;
