import Link from "next/link";

const Navbarmenu = () => {
  return (
    <>
      <nav className="navbar_section">
        <div className="container-fluid">
          <div className="row">
            <div className="col-lg-6">
              <div className="left_nav">
                <div className="logo">
                  <a className="navbar-brand " href="#">
                    Boxoniq <br />
                    <span className="navbar-text">
                      Let’s begin to continue
                    </span>{" "}
                  </a>
                </div>
                <div className="menu">
                  <Link href="/">Home</Link>
                  <a className=" active" href="#">
                    Contract US
                  </a>
                  <a className=" active" href="#">
                    About Us
                  </a>
                  <Link href="/products">Products</Link>
                </div>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="right_nav">
                <div className="search">
                  <input
                    className="form-control w-100 mr-sm-2"
                    type="search"
                    placeholder="Search for products"
                    aria-label="Search"
                  />
                  <img src="https://i.ibb.co/YBdcyGV/search-1-1.png" alt="" />
                </div>
                <div className="box_menu">
                  <div className="box_item">
                    <div className="b_menu">
                      <Link className="nav-link" href="#">
                        Account
                      </Link>
                    </div>
                    <div className="m_icon">
                      <img
                        src={"https://i.ibb.co/Zfkxf1q/user-9-1.png"}
                        alt=""
                      />
                    </div>
                  </div>
                  <div className="box_item">
                    <div className="b_menu">
                      <Link className="nav-link" href="/subscription">
                        My Subscription
                      </Link>
                    </div>
                    <div className="m_icon">
                      <img
                        src={"https://i.ibb.co/nLxB3Yv/box-2-1-1.png"}
                        alt=""
                      />
                    </div>
                  </div>
                  <div className="box_item">
                    <div className="b_menu">
                      <Link className="nav-link" href="wallet">
                        Wallet
                      </Link>
                    </div>
                    <div className="m_icon">
                      <img
                        src={"https://i.ibb.co/SsjKvWZ/wallet-3-1-1.png"}
                        alt=""
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </>
  );
};

export default Navbarmenu;
