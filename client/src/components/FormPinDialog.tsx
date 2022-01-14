import React, { FC } from 'react';
import { Button, Dialog, DialogActions, DialogContent, DialogTitle, FormHelperText } from '@material-ui/core';
// import PinField from 'react-pin-field';
import '../theme/hady/pin.css';

interface Props {
  open: boolean;
  pinMessage: string;
  isComplete: boolean;
  setPin: React.Dispatch<React.SetStateAction<number | null>>;
  setComplete: React.Dispatch<React.SetStateAction<boolean>>;
  handleClose: () => void;
}

const FormPinDialog: FC<Props> = props => {
  const { open, pinMessage, isComplete, setComplete, setPin, handleClose } = props;

  return (
    <Dialog open={open} onClose={handleClose} aria-labelledby='form-dialog-title'>
      <DialogTitle id='form-dialog-title'>Konfirmasi Akses</DialogTitle>
      <DialogContent>
        <div className='pin-field-container'>
          {/* <PinField
            length={6}
            className='pin-field'
            onChange={value => setPin(+value)}
            onComplete={() => setComplete(true)}
            disabled={isComplete}
            autoFocus
            type='password'
            validate='0123456789'
            inputMode='numeric'
          /> */}
        </div>
        <FormHelperText error={pinMessage !== ''}>{pinMessage}</FormHelperText>
      </DialogContent>
      <DialogActions>
        <Button variant='text' onClick={handleClose} color='primary'>
          Batal
        </Button>
      </DialogActions>
    </Dialog>
  );
};

export default FormPinDialog;
