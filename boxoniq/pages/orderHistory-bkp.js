import OrderHistory from "../components/History/OrderHistory";
import Footer from "../components/HomePage/Footer";
import Navbar from "../components/Navbar"

const orderHistory = () => {
  return (
    <div>
      <Navbar />
      <OrderHistory />
      <Footer />
    </div>
  );
}

export default orderHistory;