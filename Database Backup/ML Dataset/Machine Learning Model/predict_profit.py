import pickle

# Load the trained model from the pickle file
with open('polynomial_regression_model.pickle', 'rb') as f:
    model = pickle.load(f)

# Use the trained model to make a prediction on new data
x = [1] # a single row of input features
y_pred = model.predict([x])

# Print the predicted value
print(y_pred[0])