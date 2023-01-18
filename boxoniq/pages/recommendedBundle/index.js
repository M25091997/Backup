import RecommendedBundle from '../../components/BundleCreate&Subcription/RecommendedBundle';
import Footer from '../../components/HomePage/Footer';
import Navbar from '../../components/Navbar';

const recommendedBundle = () => {
    return (
        <div>
            <Navbar />
            <RecommendedBundle />
            <Footer />
        </div >
    );
};

export default recommendedBundle;