import Layout from '../components/Layout/Layout'
import '../styles/globals.css'
// import Script from "next/script";
import { wrapper } from "../redux/store"

function MyApp({ Component, pageProps }) {
  return (
    <>
      <Layout>
        <Component {...pageProps} />
      </Layout>
      {/* <Script src="../assets/js/vendor/jquery-3.5.1.min.js"></Script>
      <Script src="../assets/js/vendor/waypoints.min.js"></Script>
      <Script src="../assets/js/bootstrap.bundle.min.js"></Script>
      <Script src="../assets/js/jquery.meanmenu.js"></Script>
      <Script src="../assets/js/swiper-bundle.min.js"></Script>
      <Script src="../assets/js/owl.carousel.min.js"></Script>
      <Script src="../assets/js/jquery.fancybox.min.js"></Script>
      <Script src="../assets/js/isotope.pkgd.min.js"></Script>
      <Script src="../assets/js/parallax.min.js"></Script>
      <Script src="../assets/js/backToTop.js"></Script>
      <Script src="../assets/js/jquery.counterup.min.js"></Script>
      <Script src="../assets/js/ajax-form.js"></Script>
      <Script src="../assets/js/wow.min.js"></Script>
      <Script src="../assets/js/imagesloaded.pkgd.min.js"></Script>
      <Script src="../assets/js/main.js"></Script> */}
    </>
  );

}

export default wrapper.withRedux(MyApp);
