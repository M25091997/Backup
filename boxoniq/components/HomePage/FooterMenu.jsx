import React, { useState } from "react";
import Link from "next/link";

const FooterMenu = () => {
  const [activeNav, setActiveNav] = useState("#");
  return (
    <div className="nav-hide d-block d-sm-none">
      <nav
        style={{ backgroundColor: "#F9F249" }}
        className="nav-hider d-flex w-100 justify-content-between align-items-center"
      >
        <Link href="/">
          <a
            smooth="true"
            onClick={() => setActiveNav("#")}
            className={activeNav === "home" ? "active" : ""}
          >
            <div className="d-flex flex-column justify-content-center align-items-center">
              <div className="w-100">
                <img
                  className="w-75"
                  src="https://i.ibb.co/DpgbRg5/home-10-1.png"
                  alt=""
                />
              </div>
              <span>Home</span>
            </div>
          </a>
        </Link>
        <Link href="/populerSearches">
          <a
            smooth="true"
            onClick={() => setActiveNav("about")}
            className={activeNav === "search" ? "active" : ""}
          >
            <div className="d-flex flex-column justify-content-center align-items-center">
              <div className="w-100">
                <img
                  className="w-75"
                  src="https://i.ibb.co/3CjKTCW/search-1.png"
                  alt=""
                />
              </div>
              <span>Search</span>
            </div>
          </a>
        </Link>
        <Link href="/subscription">
          <a
            smooth="true"
            onClick={() => setActiveNav("skills")}
            className={activeNav === "subscription" ? "active" : ""}
          >
            <div className="d-flex flex-column justify-content-center align-items-center">
              <div className="w-100">
                <img
                  className="d-block mx-auto w-25"
                  src="https://i.ibb.co/9qR9qfk/box-2-1.png"
                  alt=""
                />
              </div>
              <span>My Subscription</span>
            </div>
          </a>
        </Link>
        <Link href="/wallet">
          <a
            smooth="true"
            onClick={() => setActiveNav("skills")}
            className={activeNav === "wallet" ? "active" : ""}
          >
            <div className="d-flex flex-column justify-content-center align-items-center">
              <div className="w-100">
                <img
                  className="w-75"
                  src="https://i.ibb.co/ZB9pGZN/wallet-3-1.png"
                  alt=""
                />
              </div>
              <span className="wallet-footer">Wallet</span>
            </div>
          </a>
        </Link>
      </nav>
    </div>
  );
};

export default FooterMenu;
