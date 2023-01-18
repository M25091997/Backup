import Profile from "../components/Profile";
import Navbar from "../components/Navbar"
import Footer from "../components/HomePage/Footer";

const profile = () => {
  return (
    <div>
      <Navbar />
      <Profile />
      <Footer />
    </div>
  );
}

export default profile;