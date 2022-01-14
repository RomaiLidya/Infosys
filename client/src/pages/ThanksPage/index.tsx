import { Grid, Theme, Typography } from '@material-ui/core';
import { makeStyles } from '@material-ui/styles';
import React, { FC, useContext } from 'react';
import { CurrentUserContext } from 'contexts/CurrentUserContext';
import { dummyCurrentUser } from 'utils/dummy';

const useStyles = makeStyles((theme: Theme) => ({
  Typo: {
    marginTop: theme.spacing(30),
    fontSize: '40px',
  },
}));

const ThanksPage: FC = () => {
  const { currentUser } = useContext(CurrentUserContext);
  const { firstName } = currentUser ? currentUser : dummyCurrentUser;
  const classes = useStyles();

  return (
    <Grid container spacing={1}>
      <Typography className={classes.Typo}>
        Terima Kasih Telah Melakukan Donasi {currentUser && currentUser.displayName ? currentUser.displayName : `${firstName}`}
      </Typography>
    </Grid>
  );
};

export default ThanksPage;
