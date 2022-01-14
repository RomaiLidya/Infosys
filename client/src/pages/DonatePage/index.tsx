import { Grid, InputAdornment, IconButton, Paper, TextField, Theme, Typography } from '@material-ui/core';
import { Visibility, VisibilityOff } from '@material-ui/icons';
import { makeStyles, useTheme } from '@material-ui/styles';
import React, { FC, useState, useCallback, useContext } from 'react';
import LoadingButton from 'components/LoadingButton';
import logo from 'images/donate.jpg';
import axios, { CancelTokenSource } from 'axios';
import { LOGIN_URL } from 'constants/url';
import { CurrentUserContext } from 'contexts/CurrentUserContext';
import { AuthenticationResponse } from 'typings/AuthenticationResponse';

import AppHeader from 'components/AppHeader';
import NumberFormatMask from 'components/NumberFormatMask';
import NumberFormat from 'react-number-format';
import { BLUE_SECONDARY } from 'constants/colors';

const useStyles = makeStyles((theme: Theme) => ({
  '@global': {
    body: {
      backgroundColor: '#f4f7fc'
    }
  },
  root: {
    marginTop: theme.spacing(20),
    padding: theme.spacing(3, 5)
  },
  paper: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center'
  },
  form: {
    width: '100%',
    marginTop: theme.spacing(1)
  },
  logoContainer: {
    textAlign: 'center'
  },
  color: {
    color: BLUE_SECONDARY
  },
  logo: {
    marginTop: theme.spacing(20),
    marginLeft: theme.spacing(50),
    width: '500px'
  },
  linkButton: {
    textAlign: 'center',
    padding: theme.spacing(1)
  }
}));

const DonatePage: FC = () => {
  const currentUserContext = useContext(CurrentUserContext);

  const theme = useTheme<Theme>();
  const classes = useStyles();

  const [isLoading, setLoading] = useState<boolean>(false);
  const [isAuthenticationError, setAuthenticationError] = useState<boolean>(false);

  const [email, setEmail] = useState<string>('');
  const [password, setPassword] = useState<string>('');
  const [isEmptyFieldError, setEmptyFieldError] = useState<boolean>(false);
  const [isShowPassword, setShowPassword] = useState<boolean>(false);

  const [donatePrice, setDonatePrice] = useState<number>(0);
  const [openDrawer, setOpenDrawer] = useState(true);
  const [openDrawerMobile, setOpenDrawerMobile] = useState<boolean>(false);
  const [carts, setCarts] = useState<CartModel | null>(null);
  const handleDrawerOpen = () => {
    setOpenDrawer(true);
  };

  const handleDrawerOpenMobile = () => {
    setOpenDrawerMobile(true);
  };

  const login = useCallback(async () => {
    const cancelTokenSource: CancelTokenSource = axios.CancelToken.source();
    setLoading(true);
    setAuthenticationError(false);

    try {
      const response = await axios.post(LOGIN_URL, { email, password }, { cancelToken: cancelTokenSource.token });
      const { currentUser, token }: AuthenticationResponse = response.data;
      currentUserContext.setCurrentUser(currentUser, token);
    } catch (err) {
      setLoading(false);
      setAuthenticationError(true);
    }
  }, [email, password, currentUserContext]);

  const validateLoginForm = (): boolean => {
    if (!email || !password) {
      setEmptyFieldError(true);
      return false;
    }

    return true;
  };

  const onSubmitHandler: React.FormEventHandler = async event => {
    event.preventDefault();
    setEmptyFieldError(false);

    if (validateLoginForm()) {
      login();
    }
  };

  const getPasswordFieldHelperText = (): string => {
    if (isEmptyFieldError) {
      return 'Tolong masukkan Email & kata sandi.';
    }

    if (isAuthenticationError) {
      return 'Email atau kata sandi anda salah.';
    }

    return '';
  };

  return (
    <Grid container spacing={2}>
      <AppHeader
        open={openDrawer}
        handleDrawerOpen={handleDrawerOpen}
        openMobile={openDrawerMobile}
        handleDrawerOpenMobile={handleDrawerOpenMobile}
      />

      <Grid item xs={12} sm={4} md={4} lg={4} xl={4}>
        <Paper className={classes.root}>
          <div className={classes.paper}>
            <h1> Mari Donasi</h1>
            <form className={classes.form} noValidate onSubmit={onSubmitHandler}>
              <TextField
                variant='outlined'
                margin='normal'
                required
                fullWidth
                id='email'
                label='Alamat Email'
                name='email'
                autoComplete='email'
                autoFocus
                error={isEmptyFieldError || isAuthenticationError}
                onChange={event => setEmail(event.target.value)}
                value={email}
              />
              <TextField
                variant='outlined'
                margin='normal'
                required
                fullWidth
                name='password'
                label='Kata Sandi'
                type={isShowPassword ? 'text' : 'password'}
                id='password'
                autoComplete='current-password'
                error={isEmptyFieldError || isAuthenticationError}
                helperText={getPasswordFieldHelperText()}
                onChange={event => setPassword(event.target.value)}
                value={password}
                InputProps={{
                  endAdornment: (
                    <InputAdornment position='end'>
                      <IconButton edge='end' aria-label='toggle password visibility' onClick={event => setShowPassword(!isShowPassword)}>
                        {isShowPassword ? <VisibilityOff /> : <Visibility />}
                      </IconButton>
                    </InputAdornment>
                  )
                }}
              />

              <TextField
                id='donasi'
                fullWidth
                label='Donasi'
                value={donatePrice > 0 ? donatePrice : ''}
                onChange={event => setDonatePrice(+event.target.value)}
                helperText={
                  donatePrice > 0 ? (
                    <NumberFormat value={donatePrice === 0 ? 0 : Math.ceil(donatePrice)} prefix={'Rp'} thousandSeparator={true} displayType='text' />
                  ) : (
                    ''
                  )
                }
                InputProps={{
                  inputComponent: NumberFormatMask as any
                }}
              />
              <LoadingButton
                delay={0}
                isLoading={isLoading}
                type='submit'
                fullWidth
                variant='contained'
                color='primary'
                style={{ margin: theme.spacing(2, 0, 2) }}
              >
                Submit
              </LoadingButton>

              <Typography>
                {' '}
                <h1> Quotes of the day:</h1>
              </Typography>
              <Typography>
                {' '}
                <h5 className={classes.color}>" What you do speaks so loudly that i cannot hear what you say" </h5>
              </Typography>
            </form>
          </div>
        </Paper>
      </Grid>
      <Grid item xs={12} sm={6} md={6} lg={6} xl={6}>
        <img src={logo} alt='' className={classes.logo} />
      </Grid>
    </Grid>
  );
};

export default DonatePage;
