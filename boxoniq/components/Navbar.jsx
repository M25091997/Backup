import Link from "next/link";
import React, { useState, useEffect } from "react";
import { useDispatch, useSelector } from 'react-redux';

import Router from 'next/router';

import { GiHamburgerMenu } from "react-icons/gi";
import { AiOutlineCloseSquare } from "react-icons/ai";
import { getSearchProductData } from "../redux/actions/searchproduct.actions";
import NavDropdown from 'react-bootstrap/NavDropdown';
import { base_url } from "../helpers/urlConfig";

const Navbar = () => {
  const dispatch = useDispatch();
  const [search, setSearch] = useState('');

  const [click, setClick] = useState(false);
  const handleClick = () => setClick(!click);
  const Close = () => setClick(false);
  const [checklog, setChecklog] = useState(false);
  const [logname, setLogname] = useState('');

  const goToSearch = () => {
    Router.push('/searchProduct');
  }

  const goToNextPage = (newP) => {
    Router.push(newP);
  }

  const logout = () => {
    localStorage.clear();
    Router.push('/');
    setChecklog(false);
  }

  const searchProduct = (search_key) => {
    const del = {
      "query" : search_key
    }
    // console.log(search_key,'hulu');
    // return false;
    try {
      dispatch(getSearchProductData(del));
    } catch (e) {
      console.log(e);
    }
  }


  const checkLoggedIn = () => {
    const useNme = localStorage.getItem('name');
    const useId = localStorage.getItem('user_id');
    if (useNme != null && useId != null) {
      setChecklog(true);
      setLogname(useNme);
    }
    
  }

  const LoggedIn = () => {
    return (
      <Link href="/login">
        <a activeClassName="active" className="nav-links">
          <button className="btn btn-nav-login">Login</button>
        </a>
      </Link>
    )
  }
  const MyAccount = () => {
    return (
      <Link href="/myProfile">
        <a activeClassName="active" className="nav-links">
          <button className="btn btn-nav-login">Hi, {logname}</button>
        </a>
      </Link>
    )
  }
  
  useEffect(() => {
    checkLoggedIn();
  },[]);

  return (
    <header style={{ backgroundColor: "#EDEBEB" }}>
      <div className="top-menu-container">
        <div className="d-flex align-items-center ">
          <img src="https://i.ibb.co/h7YykdW/delivery-truck.png" alt="" />
          <p className="p-0 m-0 ms-2">Free Shipping on Orders Rs. 499</p>
        </div>
        <ul className="menu-top">
          <li>
            <Link href="/refer">
              <a className="menu-top-links">
                <div className="refer">
                  <img src="https://i.ibb.co/Bytqrpg/megaphone-1.png" alt="" />
                  Refer & earn
                </div>
              </a>
            </Link>
          </li>
          <li>
            <Link href="/blogs">
              <a className="menu-top-links">Blog</a>
            </Link>
          </li>
          <li>
            <Link href="/stories">
              <a className="menu-top-links">Story</a>
            </Link>
          </li>
          <li>
            <Link href="/community">
              <a className="menu-top-links">Community</a>
            </Link>
          </li>
        </ul>
      </div>
      <div>
        <header
          className={click ? "main-container" : ""}
          onClick={() => Close()}
        />
        <nav className="navbar" onClick={(e) => e.stopPropagation()}>
          <div className="nav-container">
            <ul className={click ? "nav-menu active" : "nav-menu"}>
              <li className="nav-item">
                <Link href="/">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}
                  >
                    Home
                  </a>
                </Link>
              </li>
              <li className="nav-item">
                {checklog ? <Link href="/orderHistory">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}s
                  >
                    Order History
                  </a>
                </Link> : <Link href="/contactUs">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}
                  >
                    Contact us
                  </a>
                </Link>}
              </li>
              <li className="nav-item">
                {checklog ? <Link href="/subscriptionHistory">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}
                  >
                    Subscription History
                  </a>
                </Link> : <Link href="/aboutUs">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}
                  >
                    About us
                  </a>
                </Link>}
              </li>
              <li className="nav-item">
                <Link href="/subscription">
                  <a
                    activeClassName="active"
                    className="nav-links"
                    onClick={click ? handleClick : null}
                  >
                    My subscription
                  </a>
                </Link>
              </li>
              {checklog ?   <li className="mobileLogin">
              <NavDropdown style={{backgroundColor: '#09a42b'}} title={"Hi "+logname} id="navbarScrollingDropdown">
              <NavDropdown.Item  onClick={() => goToNextPage('/myProfile')}>MyAccount</NavDropdown.Item>
              <NavDropdown.Item onClick={() => goToNextPage('subscriptionHistory')}>
                Subscription History
              </NavDropdown.Item>
              <NavDropdown.Item onClick={() => goToNextPage('/orderHistory')}>
                Order History
              </NavDropdown.Item>
              <NavDropdown.Divider />
              <NavDropdown.Item onClick={() => logout()}>
                Logout
              </NavDropdown.Item>
            </NavDropdown>
              </li> : <Link href="/login">
                  <a activeClassName="active" className="nav-links mobileLogin">
                    <button className="btn btn-nav-login">Login</button>
                  </a>
                </Link>}
            </ul>
            <Link href="/">
              <a className="nav-logo">
                <img src={`${base_url}/images/logobox.png`} alt="logo" />
                {/* <h1 className="">Boxoniq</h1>
                <p>Let&apos;s begin to continue</p> */}
              </a>
            </Link>
            <ul className="sub-menu">
              <li>
                <div className="search position-relative">
                  <input
                    className="form-control search-control-nav w-100 mr-sm-2"
                    type="search"
                    placeholder="Search for products"
                    aria-label="Search"
                    value={search}
                    onClick={() => goToSearch()}
                    onChange={(e) => { setSearch(e.target.value); searchProduct(search);}}
                    
                  />

                  <img
                    className="position-absolute"
                    src="https://i.ibb.co/7KjcbBR/icons8-search-24-1.png"
                    alt=""
                  />
                </div>
              </li>

              <li>
                {checklog ? 
                // <Link href="/myProfile">
                //   <a activeClassName="active" className="nav-links">
                //     <button className="btn btn-nav-login">Hi, {logname}</button>
                //   </a>
                // </Link> 
                ""
                : <Link href="/login">
                  <a activeClassName="active" className="nav-links">
                    <button className="btn btn-nav-login">Login</button>
                  </a>
                </Link>}
              </li>
              <li>
                <Link href="/bundlePreview">
                  <a activeClassName="active" className="nav-links">
                    <img
                      src="https://i.ibb.co/ZG2rvHY/shopping-bag-1-1.png"
                      alt=""
                    />
                    Cart
                  </a>
                </Link>
              </li>
            {checklog ?   <li>
              <NavDropdown style={{backgroundColor: '#09a42b',borderRadius: '10%', marginTop: '42px'}} title={"Hi "+logname} id="navbarScrollingDropdown">
              <NavDropdown.Item  onClick={() => goToNextPage('/myProfile')}>MyAccount</NavDropdown.Item>
              <NavDropdown.Item onClick={() => goToNextPage('subscriptionHistory')}>
                Subscription History
              </NavDropdown.Item>
              <NavDropdown.Item onClick={() => goToNextPage('/orderHistory')}>
                Order History
              </NavDropdown.Item>
              <NavDropdown.Divider />
              <NavDropdown.Item onClick={() => logout()}>
                Logout
              </NavDropdown.Item>
            </NavDropdown>
              </li> : ""}
            </ul>
            <div className="nav-icon" onClick={handleClick}>
              {click ? <AiOutlineCloseSquare /> : <GiHamburgerMenu />}
            </div>
          </div>
        </nav>
      </div>
    </header>
  );
};

export default Navbar;
