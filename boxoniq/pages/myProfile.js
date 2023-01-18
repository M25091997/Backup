import Footer from "../components/HomePage/Footer";
import MyProfile from "../components/MyProfile/MyProfile";
import Navbar from "../components/Navbar"

const myProfile = () => {
  return (
    <div>
      <Navbar />
      <MyProfile />
      <Footer />
    </div>
  );
}

export default myProfile;