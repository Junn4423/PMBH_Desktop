import React from 'react';
import { Button, Result } from 'antd';
import { ReloadOutlined } from '@ant-design/icons';

const ErrorBoundary = ({ title = 'Đã xảy ra lỗi', subtitle, onRetry }) => {
  return (
    <Result
      status="500"
      title={title}
      subTitle={subtitle || 'Xin lỗi, đã xảy ra lỗi không mong muốn.'}
      extra={
        onRetry && (
          <Button type="primary" icon={<ReloadOutlined />} onClick={onRetry}>
            Thử lại
          </Button>
        )
      }
    />
  );
};

export default ErrorBoundary;
