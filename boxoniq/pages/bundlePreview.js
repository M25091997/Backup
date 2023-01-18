import BundlePreview from '../components/BundleCreate&Subcription/BundlePreview';
import Footer from '../components/HomePage/Footer';

import Navbar from '../components/Navbar';


const bundlePreview = () => {
    return (
        <div>
            <Navbar />
            <BundlePreview />
            <Footer />
        </div>
    );
};

export default bundlePreview;