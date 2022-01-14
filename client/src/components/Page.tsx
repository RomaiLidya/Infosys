import React, { forwardRef } from 'react';
import { Helmet } from 'react-helmet';
import { makeStyles, Theme } from '@material-ui/core';
import { BACKGROUND } from 'constants/colors';

type Props = {
  title: string;
  children: React.ReactNode;
};

const useStyles = makeStyles((theme: Theme) => ({
  root: {
    background: BACKGROUND,
    paddingTop: 15,
    marginRight: 'auto',
    marginLeft: 'auto',
    [theme.breakpoints.between('xs', 'md')]: {
      maxWidth: `${window.innerWidth}px`,
      overflowX: 'auto'
    }
  }
}));

const Page = forwardRef<HTMLDivElement, Props>((props, ref) => {
  const classes = useStyles();
  return (
    <div ref={ref} className={classes.root}>
      <Helmet>
        <title>{props.title}</title>
      </Helmet>
      {props.children}
    </div>
  );
});

export default Page;
