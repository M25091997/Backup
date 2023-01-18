import AddressBook from "../components/AddressBook/AddressBook";
import Footer from "../components/HomePage/Footer";
import Navbar from "../components/Navbar";

const addressBook = () => {
  return (
    <div>
      <Navbar />
      <AddressBook />
      <Footer />
    </div>
  );
}

export default addressBook;