import React, { FC } from 'react';
import { Breadcrumbs, Typography, makeStyles } from '@material-ui/core';
import Link from '@material-ui/core/Link';
import useRouter from 'hooks/useRouter';
import { ucWords } from 'utils';

const useStyles = makeStyles({
  active: {
    fontWeight: 500,
    fontSize: '16px',
    lineHeight: '16px'
  },
  link: {
    fontWeight: 400,
    fontSize: '16px',
    lineHeight: '32px'
  },
  breadCrumb:{
    marginTop: '3px'
  }
});

const Breadcrumb: FC = () => {
  const classes = useStyles();
  const { location, history } = useRouter();
  const path = location.pathname.split('/').filter(x => x);

  const handleClick = (path: string): React.MouseEventHandler => event => {
    event.preventDefault();
    history.push(path);
  };

  return (
    <Breadcrumbs key={1} aria-label='breadcrumb' className={classes.breadCrumb}>
      <Link key={99} color='inherit' href='/' onClick={handleClick('/')}>
        Beranda
      </Link>
      {path.map((value, index) =>
        index === path.length - 1 ? (
          <Typography key={index} className={classes.active}>{ucWords(value)}</Typography>
        ) : (
          <Link
            key={index + 1}
            color='inherit'
            href={`/${path.slice(0, index + 1).join('/')}`}
            onClick={handleClick(`/${path.slice(0, index + 1).join('/')}`)}
            className={classes.link}
          >
            {ucWords(value)}
          </Link>
        )
      )}
    </Breadcrumbs>
  );
};

export default Breadcrumb;
