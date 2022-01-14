import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { GET_CONFIRMATION_PASSWORD_URL } from 'constants/url';

interface Props {
  confirmationCreate?: boolean;
  confirmationDelete?: boolean;
  isCompletePin: boolean;
  pin: number | null;

  handleOnCreate?: (idle?: boolean) => void;
  handleOnDelete?: () => void;
  setOpenConfirmation: React.Dispatch<React.SetStateAction<boolean>>;
  setLoading: React.Dispatch<React.SetStateAction<boolean>>;
  setCompletePin: React.Dispatch<React.SetStateAction<boolean>>;
  setPin: React.Dispatch<React.SetStateAction<number | null>>;
}

const useConfirmationPin = (props: Props) => {
  const {
    pin,
    confirmationCreate,
    confirmationDelete,
    isCompletePin,
    setPin,
    setOpenConfirmation,
    setLoading,
    setCompletePin,
    handleOnCreate,
    handleOnDelete
  } = props;

  const [pinMessage, setPinMessage] = useState<string>('');

  const handleOnSubmitConfirmation = async () => {
    if (!validationPassword()) {
      return;
    }

    setPinMessage('');
    setLoading(true);
    setOpenConfirmation(false);

    try {
      const { data } = await axios.post(GET_CONFIRMATION_PASSWORD_URL, { pin: pin!.toString() });
      if (data.data.validation) {
        if (confirmationCreate && handleOnCreate) handleOnCreate(true);
        if (confirmationDelete && handleOnDelete) handleOnDelete();
        setPinMessage('');
      } else {
        setOpenConfirmation(true);
        setPinMessage('Mohon masukkan pin yang benar');
        return;
      }
    } catch (error) {
      console.log('error', error);
    } finally {
      setPin(null);
      setCompletePin(false);
      setLoading(false);
    }
  };

  const validationPassword = () => {
    let valid = true;
    if (!pin) {
      setPinMessage('PIN tidak boleh kosong.');
      valid = false;
    }

    return valid;
  };

  useEffect(() => {
    if (!isCompletePin) return;
    handleOnSubmitConfirmation();
  }, [isCompletePin]);

  return pinMessage;
};

export default useConfirmationPin;
