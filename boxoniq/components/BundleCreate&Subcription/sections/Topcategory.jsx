import { useState, useEffect } from "react";
import axios from "axios";

const Topcategory = () => {
    const [topcatData, setTopcatData] = useState([]);

    const getBundle = async () => {
        try {
            const response = await axios({
                method: "GET",
                url: "https://cms.cybertizeweb.com/boxoniq-crm/api/app/next/super-cat-bo.php"
            });
            // console.log(response, 'hulu');
            setTopcatData(response.data);
        } catch (err) {
            console.log(err);
        }
    };
    useEffect(() => {
        getBundle();
    }, []);
  return (
      <div className="button_area">
          {topcatData && topcatData.length > 0 ? topcatData.map((item) => {
                return (
                    <button key={item.id}>{item.name.slice(0,13)}</button>
                )
          }) : ""}
      </div>
  )
}

export default Topcategory