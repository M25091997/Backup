import React, { useEffect, useState } from 'react';
import { useRouter } from 'next/router';

export const MainDetail = () => {
    const router = useRouter()
    const { search } = router.query;
    useEffect(() => {
        if (search != undefined) {
            const bslug = {
                blog_slug: `${search}`,
            }
            console.log(bslug);
            return false;
            try {
                dispatch(getSingleBlog(bslug));
            } catch (e) {
                console.log(e);
            }
        }
    }, [search]);

    return (
        <div>

        </div>
    )
}
