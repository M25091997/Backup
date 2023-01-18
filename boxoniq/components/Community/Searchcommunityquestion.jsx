import React from 'react'

const Searchcommunityquestion = () => {
  return (
      <form className="half d-flex  justify-content-center">
          <input
              type="text"
              style={{ backgroundColor: "#D9D9D9" }}
              className="form-control community p-3  ps-5 rounded"
              placeholder="Search for answers, topics..."
          />
          <img
              className="community-img"
              src="https://i.ibb.co/WG0n2t0/search-6-1-1.png"
              alt=""
          />
      </form>
  )
}

export default Searchcommunityquestion