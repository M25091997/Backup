import { useState, useEffect } from "react";
import { useDispatch, useSelector } from 'react-redux';

import Accordion from "react-bootstrap/Accordion";
import { getFaqData } from "../../redux/actions/faq.actions";
const Faq = () => {
  const dispatch = useDispatch();
  const faqData = useSelector(state => state.faqData);

  // const router = useRouter();
  // const { cat } = router.query;
  // console.log(cat, 'nik');

  // const [products, setProducts] = useState([]);

  const getBundleProducts = async () => {
    try {
      dispatch(getFaqData());
    } catch (e) {
      console.log(e);
    }
    
  };

  useEffect(() => {
    getBundleProducts();
  }, []);
  return (
    <div>
      <div className="faq_section">
        <div className="row">
          <div className=" col-lg-12">
            <div className="faq_title text-center">
              <h3>FAQ</h3>
            </div>
          </div>
        </div>
        <div className="faq_details my-5">
          <div className="row justify-content-center align-items-center">
            <div className="col-sm-6 col-md-6 col-lg-6 text-center">
              <div className="faq_container">
                <Accordion defaultActiveKey="0">
                  {faqData && faqData.faqs.length > 0 ? faqData.faqs.map((faq) => {
                    return (
                      <Accordion.Item eventKey="1" key={faq.id}>
                        <Accordion.Header>{faq.faq}</Accordion.Header>
                        <Accordion.Body>
                          {faq.answer}
                        </Accordion.Body>
                      </Accordion.Item>
                    )
                  }) : ""}
                </Accordion>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Faq;
