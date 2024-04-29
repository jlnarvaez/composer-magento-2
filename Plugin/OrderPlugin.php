<?php

namespace Paycomet\Payment\Plugin;

class OrderPlugin
{
    /**
     * Before hold
     * 
     * @param \Magento\Sales\Model\Order $subject
     * @return \Magento\Sales\Model\Order[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeHold(\Magento\Sales\Model\Order $subject)
    {
        $method = $subject->getPayment()->getMethodInstance();
        if ($method->getCode() == 'paycomet_payment') {
            $method->hold($this->getPayment());
        }
        
        return [$subject];
    }
    
    /**
     * Before unhold
     * 
     * @param \Magento\Sales\Model\Order $subject
     * @return \Magento\Sales\Model\Order[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function beforeUnhold(\Magento\Sales\Model\Order $subject)
    {
        $method = $subject->getPayment()->getMethodInstance();

        if ($method->getCode() == 'paycomet_payment') {
            $method->acceptPayment($this->getPayment());
        }

        return [$subject];
    }
}
