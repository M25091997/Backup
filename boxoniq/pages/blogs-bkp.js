import Blogs from "../components/Blogs/Blogs";
import Footer from "../components/HomePage/Footer";
import Navbar from "../components/Navbar";


const blogs = () => {
    return (
        <div>
            <Navbar />
            <Blogs />
            <Footer />
        </div>
    );
}

export default blogs;