import { useState, useEffect } from "react";

const Bundleproduct = (props) => {
    const products = props.y;
    const [quantity, setQuantity] = useState(0);

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
      <div className="row mt-5">
          {products && products.length > 0 ? products.map((product) => (
              <div key={product.id} className="col-12 col-lg-6 ">
                  <div className="bundle_item">
                      <div>
                          <div className="thum">
                              <img
                                  src={product.image}
                                  alt=""
                                  style={{ height: '150px', width: '120px' }}
                              />
                          </div>
                      </div>
                      <div className="bundle_text">
                          <h3 style={{ marginLeft: "40px" }}>{product.title}</h3>
                          <p style={{ marginLeft: "40px" }}>
                              {product.desc}
                          </p>
                          <div className="bundle_footer_btn">
                              <div className="remove_btn add_to_bundle_btn">
                                  <button href="/">Add to Box</button>
                              </div>
                              <div className="select_price">
                                  <button>
                                      ₹500 / 1Kg
                                      <img
                                          src="https://i.ibb.co/4TKrXKD/Vector-4.png"
                                          alt=""
                                      />
                                  </button>
                                  <button
                                      onClick={handleDecrement}
                                      className="plus_btn "
                                  >
                                      -
                                  </button>
                                  <span className="quantity">{quantity}</span>
                                  <button
                                      onClick={handleIncrement}
                                      className="minus_btn"
                                  >
                                      +
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          )) : ""}
      </div>
  )
}

export default Bundleproduct