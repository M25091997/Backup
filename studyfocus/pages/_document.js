import Document, { Html, Head, Main, NextScript } from 'next/document'
import { base_url } from '../helpers/urlConfig';

class MyDocument extends Document {
  static async getInitialProps(ctx) {
    const initialProps = await Document.getInitialProps(ctx)
    return { ...initialProps }
  }

  render() {

    return (
      <Html>
        <Head>

          <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png" />
          <link rel="stylesheet" href={base_url + "/assets/css/bootstrap.min.css"} />
          <link rel="stylesheet" href="assets/css/meanmenu.css" />
          <link rel="stylesheet" href="assets/css/animate.min.css" />

          <link rel="stylesheet" href={base_url + "/assets/css/jquery.fancybox.min.css"} />
          <link rel="stylesheet" href={base_url + "/assets/css/fontAwesome5Pro.css"} />
          <link rel="stylesheet" href={base_url + "/assets/css/elegantFont.css"} />
          <link rel="stylesheet" href={base_url + "/assets/css/default.css"} />
          <link rel="stylesheet" href={base_url + "/assets/css/style.css"} />
          <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"></link>
        
          <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=GTM-M8VZZGF"
          />

          <script
            dangerouslySetInnerHTML={{
              __html: `
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', 'GTM-M8VZZGF', { page_path: window.location.pathname });
            `,
            }}
          />
        
        </Head>
        <body>
          <Main />
          <NextScript />
          <script src={base_url + "/assets/js/vendor/jquery-3.5.1.min.js"}></script>
          <script src={base_url + "/assets/js/bootstrap.bundle.min.js"}></script>
          <script src={base_url + "/assets/js/swiper.bundle.min.js"}></script>
          <script src={base_url + "/assets/js/jquery.meanmenu.js"}></script>
          <script src={base_url + "/assets/js/main.js"}></script>
        </body>
      </Html>
    )
  }
}

export default MyDocument