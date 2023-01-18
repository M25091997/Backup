import BundleCreator from '../components/BundleCreate&Subcription/BundleCreator';
import Footer from '../components/HomePage/Footer';
import Navbar from '../components/Navbar';

const bundleCreator = () => {
    return (
        <div>
            <Navbar />
            <BundleCreator />
            <Footer />
        </div >
    );
};

export default bundleCreator;