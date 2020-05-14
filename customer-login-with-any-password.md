# Customer login using any password.

Comment out one row in the authenticate function to allow login with any customer without providing a valid passsword.

//            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));

 ```
class Magento\Customer\Model\AccountManagement implements AccountManagementInterface
{
...
    public function authenticate($username, $password)
    {
        try {
            $customer = $this->customerRepository->get($username);
        } catch (NoSuchEntityException $e) {
            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
        }

        $customerId = $customer->getId();
        if ($this->getAuthentication()->isLocked($customerId)) {
            throw new UserLockedException(__('The account is locked.'));
        }
        try {
            $this->getAuthentication()->authenticate($customerId, $password);
        } catch (InvalidEmailOrPasswordException $e) {
//            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
        }
        if ($customer->getConfirmation() && $this->isConfirmationRequired($customer)) {
            throw new EmailNotConfirmedException(__('This account is not confirmed.'));
        }

        $customerModel = $this->customerFactory->create()->updateData($customer);
        $this->eventManager->dispatch(
            'customer_customer_authenticated',
            ['model' => $customerModel, 'password' => $password]
        );

        $this->eventManager->dispatch('customer_data_object_login', ['customer' => $customer]);

        return $customer;
    }
...
}
```