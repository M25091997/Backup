import OrderHistoryDetail from "../../components/History/OrderHistoryDetail";
import Footer from "../../components/HomePage/Footer";
import Navbar from "../../components/Navbar";

const orderHistory = () => {
    return (
        <div>
            <Navbar />
            <OrderHistoryDetail />
            <Footer />
        </div>
    );
}

export default orderHistory;