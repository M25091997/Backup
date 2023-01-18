import { AiTwotoneStar, AiOutlineStar } from "react-icons/ai";
import { useState } from "react";

const HimalayaSoap = () => {
  const [quantity, setQuantity] = useState(1);

  const handleDecrement = () => {
    if (quantity > 0) {
      setQuantity(quantity - 1);
    } else {
      setQuantity(0);
    }
  };

  const handleIncrement = () => {
    setQuantity(quantity + 1);
  };

  return (
    <div className="himalaya_soap_container">
      <div className="profile_section">
        <div className="container-fluid p_50">
          <div className="row">
            <div className="col-lg-12">
              <div className=" text-center himalay_container_title ">
                <h4 className="global_himalaya_title">Himalaya Soap</h4>
              </div>
            </div>
          </div>
          <div className="row himalay_container">
            <div className="col-lg-10">
              <div className="row himalay_container">
                <div className="col-lg-5 mb-3">
                  <div className="himalaya_img">
                    <img src="images/himalay 1.png" alt="" />
                  </div>
                  <div className="himalaua_price_quantity_container">
                    <div className="himalaya_title">
                      <h3>Himalaya Soap</h3>
                    </div>
                    <div className="himalaya_price_quantity">
                      <div className="himalay_quantity">
                        <h5>MRP</h5>
                        <h5>Price</h5>
                        <h5>Quantity</h5>
                      </div>
                      <div className="himalay_price">
                        <h5>₹ 100</h5>
                        <h5>₹ 100</h5>
                        <div className="Soap_quantity_buttons">
                          <button
                            onClick={handleDecrement}
                            className="Soap_quantity_minus"
                          >
                            -
                          </button>{" "}
                          <span className="soap_number">{quantity}</span>
                          <button
                            onClick={handleIncrement}
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
                      <h3>Product Description</h3>
                    </div>
                    <div className="product_description_buttons">
                      <button className="product_des_button">50gm</button>
                      <button className="product_des_button white_button">
                        100gm
                      </button>
                    </div>
                  </div>
                  <div className="shop_cart_buttons">
                    <button className="shop_now">Shop Now</button>
                    <button className="add_cart">Add to Cart</button>
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
                    <div className="review_rating_single_part">
                      <div className="ratings_des">
                        <h3>Sabir Alam</h3>
                        <h6>2022-08-15</h6>
                        <p>Nice</p>
                      </div>
                      <div className="rating_stars">
                        <span className="full_stars">
                          <AiTwotoneStar />
                          <AiTwotoneStar />
                          <AiTwotoneStar />
                          <AiTwotoneStar />
                        </span>
                        <span className="half_stars">
                          <AiOutlineStar />
                        </span>
                      </div>
                    </div>
                    <div className="send_reviews">
                      <div className="write_reviews">
                        <h3>Write your review and rating here</h3>
                        <p>
                          It is a long established fact that a reader will be
                          distracted by the readable content of a page when
                          looking at its layout.
                        </p>
                      </div>
                      <div className="horzontal_border"></div>
                      <div className="send_review_stars">
                        <span className="half_stars_review">
                          <AiOutlineStar />
                          <AiOutlineStar />
                          <AiOutlineStar />
                          <AiOutlineStar />
                          <AiOutlineStar />
                        </span>
                      </div>
                      <div className="save_button">
                        <button>Save</button>
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

export default HimalayaSoap;
