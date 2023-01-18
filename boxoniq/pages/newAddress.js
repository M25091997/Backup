import NewAdress from "../components/AddressBook/NewAdress";
import Footer from "../components/HomePage/Footer";
import Navbar from "../components/Navbar"

const newAddress = () => {
  return (
    <div>
      <Navbar />
      <NewAdress />
      <Footer />
    </div>
  );
}

export default newAddress;