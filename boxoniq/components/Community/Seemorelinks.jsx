import React from 'react'
import Link from 'next/link';

const Seemorelinks = () => {
  return (
    <>
          <Link href='/subscriptionHistory'>
              <button className="btn w-100 text-start rounded bg-white py-2 my-1 see_more">
                  Subscription History
              </button>
          </Link>
          <Link href='orderHistory'>
              <button className="btn w-100 text-start rounded bg-white  py-2 my-1 see_more">
                  Order History
              </button>
          </Link>
          <Link href='addressBook'>
              <button className="btn w-100 text-start rounded bg-white  py-2 my-1 see_more">
                  Address Book
              </button>
          </Link>
          <Link href='policy'>
              <button className="btn w-100 text-start rounded bg-white  py-2 my-1 see_more">
                  Policies
              </button>
          </Link>
         <Link href='/faq'>
              <button className="btn w-100 text-start rounded bg-white  py-2 my-1 see_more">
                  FAQs
              </button>
         </Link>
          <Link href='/cart'>
              <button className="btn w-100 text-start rounded bg-white  py-2 my-1 see_more">
                  My Cart
              </button>
          </Link>
    </>
  )
}

export default Seemorelinks