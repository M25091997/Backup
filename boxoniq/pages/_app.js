import 'bootstrap/dist/css/bootstrap.css';

import './styles.css'
import './custom_styles.css'
import './community.css'
import "./Home.css"
import './blog.css'
import "./main.css"
import "../styles/globals.css"
import { wrapper } from "../redux/store";





function MyApp({ Component, pageProps }) {
  return (

    <Component {...pageProps} />
  )
}

// export default MyApp
export default wrapper.withRedux(MyApp);

