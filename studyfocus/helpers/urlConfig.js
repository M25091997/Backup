// const path = require('path');
const dev = 'http://localhost/study-focus';
// const live = 'https://studyfocus.in';
const live = 'https://cybertizeweb.com/cms/studyfocus';


export const base_url = 'https://studyfocus.in/';
export const base_url_tutor = 'https://studyfocus.in/tutors/';
export const base_url_ins = 'https://studyfocus.in/institutes/';
export const base_url_counc = 'https://studyfocus.in/councellors/';

// export const base_url = 'https://studyfocusnext.vercel.app/';
// export const base_url_tutor = 'https://studyfocusnext.vercel.app/tutors/';
// export const base_url_ins = 'https://studyfocusnext.vercel.app/institutes/';
// export const base_url_counc = 'https://studyfocusnext.vercel.app/councellors/';


// export const base_url_tutor = 'http://localhost:3000/tutors/';
// export const base_url_ins = 'http://localhost:3000/institutes/';
// export const base_url_counc = 'http://localhost:3000/councellors/';

// export const base_url = 'http://localhost:3000/';


export const api = `${live}/cybertechMedia/api/new-study-api/`;

// const url_file = 'https://studyfocus.in/img';
const url_file = 'https://cybertizeweb.com/cms/studyfocus/img';


export const generatePublicUrl = (fileName) => {
    return `${url_file}/${fileName}`;
}